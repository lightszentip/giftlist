<?php

class ControllerPresentShare implements InterfaceController {

    private $request = null;
    private $view = null;
    private $messageResolver = null;
    private $presentDao = null;
    private $success = false;

    public function __construct($request, $jdbcTemplate, InterfaceSecurity $login) {
        $this->view = new AjaxView();
        $this->request = $request;
        $this->messageResolver = AppFactory::getMessageResolver();
        $this->presentDao = new PresentDao($jdbcTemplate);
    }

    public function process() {
        $presentId = EscapeHelper::escape($this->request['post']['presentId'], EscapeHelper::TARGET_NUMBER);
        $emailFrom = EscapeHelper::escape($this->request['post']['emailfrom'], EscapeHelper::TARGET_STRING);
        $emailTo = EscapeHelper::escape($this->request['post']['emailto'], EscapeHelper::TARGET_STRING);
        $nameFrom = EscapeHelper::escape($this->request['post']['namefrom'], EscapeHelper::TARGET_STRING);
        $nameTo = EscapeHelper::escape($this->request['post']['nameto'], EscapeHelper::TARGET_STRING);
        $content = EscapeHelper::escape($this->request['post']['content'], EscapeHelper::TARGET_STRING);
        $error = new ErrorModel();
        if (HelperUtil::isNullOrEmptyString($emailFrom) && !filter_var($emailFrom, FILTER_VALIDATE_EMAIL)) {
            $error->addErrorField("emailfrom", "error_share_emailfrom");
        }
        if (HelperUtil::isNullOrEmptyString($emailTo)) {
            $error->addErrorField("emailto", "error_share_emailto");
        } else if (!filter_var($emailTo, FILTER_VALIDATE_EMAIL)) {
            $to = explode(';', $emailTo);
            foreach ($to as $toMailAddress) {
                if (!filter_var($toMailAddress, FILTER_VALIDATE_EMAIL)) {
                    $error->addErrorField("emailto", "error_share_emailto");
                }
            }
        }
        if (HelperUtil::isNullOrEmptyString($nameFrom)) {
            $error->addErrorField("namefrom", "error_share_namefrom");
        }
        $present = null;
        if (empty($presentId)) {
            $error->addErrorField("content", "error_share_presentId");
        } else {
            $present = $this->presentDao->getById($presentId);
            if ($present == null) {
                $error->addErrorField("content", "error_share_presentId");
            }
        }
        if ($error->hasError()) {
            $this->view->assign("emailfrom", $emailFrom);
            $this->view->assign("presentId", $presentId);
            $this->view->assign("emailto", $emailTo);
            $this->view->assign("namefrom", $nameFrom);
            $this->view->assign("nameto", $nameTo);
            $this->view->assign("content", $content);
        } else {
            $this->sendEmailUsePresent($emailTo, $emailFrom, $content, $nameFrom, $nameTo, $present);
            $this->success = true;
        }
        $this->view->assign("error", $error);
    }

    public function display() {
        if ($this->success) {
            $this->view->setTemplate("share_success");
        } else {
            $this->view->setTemplate("share_modal");
        }
        $this->view->assign("messageResolver", $this->messageResolver);
        return $this->view->loadTemplate();
    }

    /**
     * 
     * @param type $to
     * @param type $from
     * @param type $content
     * @param type $nameFrom
     * @param type $nameTo
     * @param PresentModel $present
     */
    private function sendEmailUsePresent($to, $from, $content, $nameFrom, $nameTo, PresentModel $present) {
        $toAddresses = explode(';', $to);
        $mailTemplate = new MailTemplate("emailshare", AppFactory::getTemplateEngine(TEMPLATE_PATH));
        $url = APP_URL . "?mapping=present/view&presentId=" . $present->getId();
        $info = $this->messageResolver->getMessage("email_share_present_info") . APP_NAME;
        $subject = "[" . APP_ABBREVIATION . "]" . $this->messageResolver->getMessage("email_share_present_subject", array($nameFrom, $present->getTitle()));
        if (!HelperUtil::isNullOrEmptyString($nameTo)) {
            $salutation = $this->messageResolver->getMessage("email_share_present_toName") . " " . $nameTo . ",";
        } else {
            $salutation = $this->messageResolver->getMessage("email_share_present_toName") . ",";
        }
        $mailTemplate->assign("text", $this->messageResolver->getMessage("email_share_present_text_html", array($nameFrom, $present->getTitle(), $url, APP_NAME)) . "<br />" . $content);
        $mailTemplate->assign("salutation", $salutation);
        $mailTemplate->assign("info", $info);
        $text = $salutation . "\n" . $this->messageResolver->getMessage("email_share_present_text", array($nameFrom, $present->getTitle(), $url, APP_NAME)) . "\n\n" . $content . "\n\n" . $info;
        foreach ($toAddresses as $toAddress) {
            HelperUtil::sendEmail($toAddress, $from, $from, $mailTemplate->getHtml(), $text, $subject);
        }
    }

}