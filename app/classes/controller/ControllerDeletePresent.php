<?php

class ControllerDeletePresent implements InterfaceController {

    private $request = null;
    private $view = null;
    private $messageResolver = null;
    private $presentDao = null;

    public function __construct($request, $jdbcTemplate, InterfaceSecurity $login) {
        $this->view = new BackendView($login->getSecurityModel());
        $this->request = $request;
        $this->messageResolver = AppFactory::getMessageResolver();
        $this->presentDao = new PresentDao($jdbcTemplate);
    }

    public function process() {
        $present = null;
        if (!empty($this->request['get']['presentId'])) {
            $presentId = EscapeHelper::escape($this->request['get']['presentId'], EscapeHelper::TARGET_NUMBER);
            $present = $this->presentDao->getById($presentId);
        }
        $targetLocation = null;
        if ($present != null && $present->getStatus() != 1) {
            $result = $this->presentDao->delete($presentId);
            if ($result) {
                $targetLocation = APP_URL . "?mapping=admin&success=deletePresent&args=" . base64_encode("presentId=$presentId&result=1");
            } else {
                $targetLocation = APP_URL . "?mapping=admin&success=deletePresent&args=" . base64_encode("presentId=$presentId&result=2");
            }
        } else {
            $targetLocation = APP_URL . "?mapping=admin&success=deletePresent&args=" . base64_encode("presentId=$presentId&result=2");
        }
        header("Location: $targetLocation");
    }

    public function display() {
        return $this->view->loadTemplate();
    }

}