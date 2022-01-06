<?php

class ControllerUsePresent implements InterfaceController {

    private $request = null;
    private $view = null;
    private $messageResolver = null;
    private $presentDao = null;
    private $appDebugger = null;

    public function __construct($request, $jdbcTemplate, InterfaceSecurity $login) {
        $this->view = new FrontendView();
        $this->request = $request;
        $this->messageResolver = AppFactory::getMessageResolver();
        $this->presentDao = new PresentDao($jdbcTemplate);
        $this->appDebugger = AppFactory::getDebugger(IS_DEBUG);
    }

    public function process() {
        //VIEW or Process
        $success = null;
        $isError = false;
        if (!empty($this->request['get']['success'])) {
            $success = EscapeHelper::escape($this->request['get']['success'], EscapeHelper::TARGET_STRING);
        }
        if (!empty($success) && $success == "view") {
            $args = EscapeHelper::escape($this->request['get']['args'], EscapeHelper::TARGET_STRING);
            $parameter = base64_decode($args);
            list($parameterCode, $parameterId) = explode("&", $parameter);
            $presentId = EscapeHelper::escape(str_replace("presentId=", "", $parameterId), EscapeHelper::TARGET_NUMBER);
            $code = EscapeHelper::escape(str_replace("code=", "", $parameterCode), EscapeHelper::TARGET_STRING);
            if (!empty($presentId) && !empty($code)) {
                $present = $this->presentDao->getById($presentId);
                if ($present->getCode() == $code) {
                    $this->view->assign("present", $present);
                } else {
                    $isError = true;
                    $this->view->assign("error", $this->messageResolver->getMessage("error_parameter_error"));
                }
            } else {
                $isError = true;
                $this->view->assign("error", $this->messageResolver->getMessage("error_parameter_error"));
            }
        } else {
            $presentId = EscapeHelper::escape($this->request['post']['presentId'], EscapeHelper::TARGET_NUMBER);
            $email = null;
            $isError = false;
            $code = "";
            $emailInput = $this->request['post']['email'];
            if (!empty($emailInput)) {
                $this->appDebugger->debug($emailInput);
                $emailInput = EscapeHelper::escape($emailInput, EscapeHelper::TARGET_STRING);
                if (!empty($emailInput) && $emailInput != "" && HelperUtil::checkEmailAddress($emailInput)) {
                    $email = $emailInput;
                } else {
                    $isError = true;
                    $this->view->assign("error", $this->messageResolver->getMessage("error_validate_email"));
                }
            }
            $this->appDebugger->trace();
            $this->appDebugger->debug($presentId);
            $this->appDebugger->debug($email);
            if (!$isError) {
                if (!empty($presentId) && $presentId > 0) {
                    $present = $this->presentDao->getById($presentId);
                    $this->appDebugger->debug($present);
                    if ($present != NULL && $present->getCode() == null) {
                        $generateCode = "";
                        do {
                            $generateCode = $this->getCodeValue();
                        } while ($this->presentDao->existCode($generateCode));

                        if ($this->presentDao->usePresent($presentId, $generateCode)) {
                            $this->view->assign("code", $generateCode);
                            $code = $generateCode;
                            if (!empty($email)) {
                                if (!$this->sendEmailUsePresent($email, $present, $generateCode)) {
                                    $isError = true;
                                    $this->view->assign("error", $this->messageResolver->getMessage("error_send_email"));
                                }
                            }
                        } else {
                            $isError = true;
                            $this->view->assign("error", $this->messageResolver->getMessage("error_update_present_db"));
                        }
                    } else {
                        $isError = true;
                        $this->view->assign("error", $this->messageResolver->getMessage("error_notfound_present"));
                    }
                } else {
                    $isError = true;
                    $this->view->assign("error", $this->messageResolver->getMessage("error_empty_presentId"));
                }
            }
            if (!$isError) {
                $targetLocation = APP_URL . "?mapping=present/waehlen&success=view&args=" . base64_encode("code=$code&presentId=$presentId");
                header("Location: $targetLocation");
            }
        }
        $this->view->assign("isError", $isError);
    }

    public function display() {
        $this->view->setTemplate("usepresent");
        $this->view->assign("messageResolver", $this->messageResolver);
        return $this->view->loadTemplate();
    }

    private function getCodeValue() {
        $signs = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'U', 'V', 'W', 'X', 'Y', 'Z', '$', '%', '/', '(', '_', '-', ';', '1', '2', '3', '4', '5', '6', '7', '8', '9', '0');
        $int_array = count($signs);
        $dates = array(date("Hmsdi"), date("Hdims"), date("msHdi"));
        $code = hash("crc32b", $dates[rand(0, count($dates) - 1)] . rand(0, 99));
        for ($i = 0; $i < PRESENT_CODE_LENGTH_ADD; $i++) {
            $code .= $signs[rand(0, $int_array - 1)];
        }
        return $code;
    }

    private function sendEmailUsePresent($to, PresentModel $present, $code) {
        $mailTemplate = new MailTemplate("emailusepresent", AppFactory::getTemplateEngine(TEMPLATE_PATH));
        $url = APP_URL . "?mapping=present/release&releasecode=$code";
        $viewUrl = APP_URL . "?mapping=present/view&presentId=" . $present->getId();
        $salutation = $this->messageResolver->getMessage("email_use_present_salutation") . APP_NAME;
        $info = $this->messageResolver->getMessage("email_use_present_info");
        $subject = APP_ABBREVIATION . $this->messageResolver->getMessage("email_use_present_subject");
        $mailTemplate->assign("text", $this->messageResolver->getMessage("email_use_present_text_html", array($present->getTitle(), $url, $viewUrl)));
        $mailTemplate->assign("salutation", $salutation);
        $mailTemplate->assign("info", $info);
        $text = $salutation . "\n" . $this->messageResolver->getMessage("email_use_present_text", array($present->getTitle(), $url, $viewUrl)) . "\n\n" . $info;
        return HelperUtil::sendEmail($to, PRESENT_EMAIL_FROM, PRESENT_EMAIL_REPLY, $mailTemplate->getHtml(), $text, $subject);
    }

}
