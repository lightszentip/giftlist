<?php

class ControllerLogin implements InterfaceController {

    private $request = null;
    private $view = null;
    private $messageResolver = null;
    private $target;
    private $isError;
    private $login;

    /**
     * 
     * @param type $request
     * @param InterfaceSecurity $login
     * @param type $defaultTarget
     */
    public function __construct($request, InterfaceSecurity $login, $defaultTarget = "admin") {
        $this->view = new LoginView($login->getSecurityModel());
        $this->request = $request;
        $this->messageResolver = AppFactory::getMessageResolver();
        if (empty($this->request['post']['next'])) {
            $this->target = $defaultTarget;
        } else {
            $this->target = EscapeHelper::escape($this->request['post']['next'], EscapeHelper::TARGET_STRING);
        }
        $this->isError = false;
        $this->login = $login;
    }

    public function process() {
        if (!$this->login->isAppLoggedIn()) {
            $targetLocation = APP_URL . "?mapping=" . $this->target;
            $this->isError = $this->login->appLoginRequest($targetLocation);
        } else {
            $targetLocation = APP_URL . "?mapping=" . $this->target;
            header("Location: $targetLocation");
        }
    }

    public function display() {
        $this->view->setTemplate($this->login->getLoginView());
        $this->view->assign("messageResolver", $this->messageResolver);
        $this->view->assign($this->login->getLoginViewVars());
        $this->view->assign("target", $this->target);
        $this->view->assign("isErrorMessage", $this->isError);
        return $this->view->loadTemplate();
    }

}
