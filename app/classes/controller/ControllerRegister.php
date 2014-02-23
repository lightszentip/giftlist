<?php

class ControllerRegister implements InterfaceController {

    private $request = null;
    private $view = null;
    private $messageResolver = null;
    private $login;

    public function __construct($request, $jdbcTemplate, InterfaceSecurity $login) {
        $this->view = new BackendView($login->getSecurityModel());
        $this->request = $request;
        $this->messageResolver = AppFactory::getMessageResolver();
        $this->login = $login;
    }

    public function process() {
        if (!isset($this->request["post"]["register"]) && isset($this->request["get"]["id"]) && isset($this->request["get"]["verification_code"])) {
            $this->login->processRegister();
        }
    }

    public function display() {
        $this->view->setTemplate($this->login->getRegisterView());
        $this->view->assign("messageResolver", $this->messageResolver);
        $this->view->assign($this->login->getRegisterViewVars());
        $this->view->assign("isRegisterConfirm", true);
        return $this->view->loadTemplate();
    }

}