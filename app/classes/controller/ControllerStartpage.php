<?php

class ControllerStartpage implements InterfaceController {

    private $request = null;
    private $view = null;
    private $messageResolver = null;
    private $presentDao = null;

    public function __construct($request, $jdbcTemplate, InterfaceSecurity $login) {
        $this->view = new FrontendView();
        $this->request = $request;
        $this->messageResolver = AppFactory::getMessageResolver();
        $this->presentDao = new PresentDao($jdbcTemplate);
    }

    public function process() {
        $view = null;
        if (!empty($this->request['get']['view'])) {
            $view = EscapeHelper::escape($this->request['get']['view'], EscapeHelper::TARGET_STRING);
        }
        if ($view == "grid") {
            $this->view->assign("view", "grid");
        } else {
            $this->view->assign("view", "list");
        }
        $presentlist = $this->presentDao->getAllFreePresents();
        $this->view->assign("presents", $presentlist->getItems());
        $this->view->assign("error", new ErrorModel());
    }

    public function display() {
        $this->view->setTemplate("presenttable");
        $this->view->assign("messageResolver", $this->messageResolver);
        $this->view->assign("emailfrom", "");
        $this->view->assign("namefrom", "");
        $this->view->assign("emailto", "");
        $this->view->assign("nameto", "");
        $this->view->assign("content", "");
        return $this->view->loadTemplate();
    }

}
