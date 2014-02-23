<?php

class ControllerReleasePresent implements InterfaceController {

    private $request = null;
    private $view = null;
    private $messageResolver = null;
    private $presentDao = null;
    private $appLogger = null;
    private $appDebugger = null;

    public function __construct($request, $jdbcTemplate, InterfaceSecurity $login) {
        $this->view = new FrontendView();
        $this->request = $request;
        $this->messageResolver = AppFactory::getMessageResolver();
        $this->presentDao = new PresentDao($jdbcTemplate);
        $this->appLogger = AppFactory::getLogger(LOG_MODE);
        $this->appDebugger = AppFactory::getDebugger(IS_DEBUG);
    }

    public function process() {
        $success = null;
        $isError = false;
        $isForm = false;
        if (!empty($this->request['get']['success'])) {
            $success = EscapeHelper::escape($this->request['get']['success'], EscapeHelper::TARGET_STRING);
        }
        if (!empty($success) && $success == "view") {
            $args = EscapeHelper::escape($this->request['get']['args'], EscapeHelper::TARGET_STRING);
            $parameter = base64_decode($args);
            $presentId = EscapeHelper::escape(str_replace("presentId=", "", $parameter), EscapeHelper::TARGET_NUMBER);
            $present = $this->presentDao->getById($presentId);
            if ($present != null) {
                $this->view->assign("present", $present);
                $this->view->assign("isSuccess", true);
            } else {
                $isError = true;
                $this->view->assign("error", $this->messageResolver->getMessage("error_notfound_present"));
            }
        } else {
            $releaseCode = null;
            $releaseButton = null;
            if (!empty($this->request['post']['releasecode'])) {
                $releaseCode = EscapeHelper::escape($this->request['post']['releasecode'], EscapeHelper::TARGET_STRING);
            }
            if (!empty($this->request['post']['releasebutton'])) {
                $releaseButton = EscapeHelper::escape($this->request['post']['releasebutton'], EscapeHelper::TARGET_STRING);
            }
            if (!empty($releaseCode) && !empty($releaseButton)) {
                $present = $this->presentDao->getByCode($releaseCode);
                if ($present != null) {
                    $this->presentDao->releasePresent($present->getId());
                    $this->appLogger->info('Das Geschenk ' . $present->getId() . ' wurde wieder freigegeben.');
                    $targetLocation = APP_URL . "?success=view&args=" . base64_encode("presentId=$present -> getId()");
                    header("Location: $targetLocation");
                }
            } else {
                $releaseCode = null;
                if (!empty($this->request['get']['releasecode'])) {
                    $releaseCode = EscapeHelper::escape($this->request['get']['releasecode'], EscapeHelper::TARGET_STRING);
                }
                if (!empty($releaseCode)) {
                    $this->appDebugger->debug($releaseCode);
                    $present = $this->presentDao->getByCode($releaseCode);
                    $this->appDebugger->debug($present);
                    if ($present != null) {
                        $this->view->assign("present", $present);
                        $this->view->assign("isView", true);
                        $this->view->assign("releasebutton", rand(0, 99) . rand(0, 99) . rand(0, 99) . rand(0, 99));
                        $this->view->assign("releasecode", $releaseCode);
                    } else {
                        $isError = true;
                        $this->view->assign("error", $this->messageResolver->getMessage("error_notfound_present"));
                    }
                } else {
                    $isForm = true;
                }
            }
        }
        $this->view->assign("isForm", $isForm);
        $this->view->assign("isError", $isError);
    }

    public function display() {
        $this->view->setTemplate("releasepresent");
        $this->view->assign("messageResolver", $this->messageResolver);
        return $this->view->loadTemplate();
    }

}