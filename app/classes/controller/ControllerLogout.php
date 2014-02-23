<?php

class ControllerLogout implements InterfaceController {

    private $login;

    /**
     * 
     * @param InterfaceSecurity $login
     */
    public function __construct(InterfaceSecurity $login) {
        $this->login = $login;
    }

    public function process() {
        $this->login->appLogout();
        $targetLocation = APP_URL;
        header("Location: $targetLocation");
    }

    public function display() {
    }

}