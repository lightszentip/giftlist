<?php

class ControllerPresentDetailView implements InterfaceController {

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
        $isError = false;
        if (!empty($this->request['get']['presentId'])) {
            $presentId = EscapeHelper::escape($this->request['get']['presentId'], EscapeHelper::TARGET_NUMBER);
            $present = $this->presentDao->getById($presentId);
            $this->view->assign("present", $present);
        } else {
            $isError = true;
            $this->view->assign("error", $this->messageResolver->getMessage("error_parameter_error"));
        }
        $this->view->assign("isError", $isError);
    }

    public function display() {
        $this->view->setTemplate("detailview");
        $this->view->assign("messageResolver", $this->messageResolver);
        return $this->view->loadTemplate();
    }

}
