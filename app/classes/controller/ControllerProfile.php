<?php

class ControllerProfile implements InterfaceController {

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
        $isEdit = false;
        if (filter_has_var(INPUT_POST, "profil_data")) {
            $this->login->processEditProfil();
            $isEdit = true;
        }
        if (filter_has_var(INPUT_POST, "profil_password")) {
            $this->login->processEditPassword();
            $isEdit = true;
        }
        $login = $this->login->getProfilViewVars();
        if ($isEdit && !$login['login']->errors) {
            $_SESSION['profil_messages'] = $login['login']->messages;
            $targetLocation = APP_URL . "?mapping=user/profile&success=save";
            header("Location: $targetLocation");
        }
    }

    public function display() {
        if (filter_has_var(INPUT_GET, "success")) {
            $messages = $_SESSION['profil_messages'];
            $this->view->assign("messages", $messages);
            unset($messages);
            $_SESSION['profil_messages'] = null;
        } else {
            $this->view->assign("messages", null);
        }
        $this->view->setTemplate($this->login->getProfilView());
        $this->view->assign("messageResolver", $this->messageResolver);
        $this->view->assign($this->login->getProfilViewVars());
        $security = $this->login->getSecurityModel();
        $this->view->assign("username", $security->getUserName());
        $this->view->assign("email", $security->getEmail());
        return $this->view->loadTemplate();
    }

}