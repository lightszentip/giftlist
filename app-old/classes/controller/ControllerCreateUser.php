<?php

class ControllerCreateUser implements InterfaceController {

    private $request = null;
    private $view = null;
    private $messageResolver = null;
    private $login;

    /**
     * 
     * @param type $request
     * @param type $jdbcTemplate
     * @param InterfaceSecurity $login
     */
    public function __construct($request, $jdbcTemplate, InterfaceSecurity $login) {
        $this->view = new BackendView($login->getSecurityModel());
        $this->request = $request;
        $this->messageResolver = AppFactory::getMessageResolver();
        $this->login = $login;
    }

    public function process() {
        $this->login->processRegister();
    }

    public function display() {
        $this->view->setTemplate($this->login->getRegisterView());
        $this->view->assign("messageResolver", $this->messageResolver);
        $this->view->assign($this->login->getRegisterViewVars());
        $this->view->assign("isRegisterConfirm", false);
        return $this->view->loadTemplate();
    }

}