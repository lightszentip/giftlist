<?php

class ControllerResetPassword implements InterfaceController {

    private $request = null;
    private $view = null;
    private $messageResolver = null;
    private $login;

    public function __construct($request, $jdbcTemplate, InterfaceSecurity $login) {
        $this->view = new AjaxView(TEMPLATE_PATH_BACKEND);
        $this->request = $request;
        $this->messageResolver = AppFactory::getMessageResolver();
        $this->login = $login;
    }

    public function process() {
        $isSuccess = false;
        if (filter_input(INPUT_POST, "request_password_reset") != null && filter_input(INPUT_POST, "user_name") != null) {
            $isSuccess = $this->login->setPasswordResetDatabaseTokenAndSendMail();
        } else if (filter_input(INPUT_POST, "submit_new_password") != null) {
            $isSuccess = $this->login->editNewPassword();
        } else if (filter_input(INPUT_GET, "user_name") != null && filter_input(INPUT_GET, "verification_code") != null) {
            $this->login->checkIfEmailVerificationCodeIsValid();
        }
        $this->view->assign("isSuccess", $isSuccess);
    }

    public function display() {
        if ($this->login->resetLinkIsValid()) {
            $this->view->setTemplate($this->login->getResetConfirmView());
            $this->view->assign("userName", $this->request["get"]["user_name"]);
            $this->view->assign("verificationCode", $this->request["get"]["verification_code"]);
        } else {
            $this->view->setTemplate($this->login->getResetView());
        }
        $this->view->assign("messageResolver", $this->messageResolver);
        $this->view->assign($this->login->getProfilViewVars());
        return $this->view->loadTemplate();
    }

}