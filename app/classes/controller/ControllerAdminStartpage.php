<?php

class ControllerAdminStartpage implements InterfaceController {

    private $request = null;
    private $view = null;
    private $messageResolver = null;
    private $presentDao = null;

    /**
     * 
     * @param type $request
     * @param type $jdbcTemplate
     * @param SecurityModel $security
     */
    public function __construct($request, $jdbcTemplate, InterfaceSecurity $login) {
        $this -> view = new BackendView($login->getSecurityModel());
        $this -> request = $request;
        $this -> messageResolver = AppFactory::getMessageResolver();
        $this -> presentDao = new PresentDao($jdbcTemplate);
    }

    /**
     * Process data
     */
    public function process() {
        $presentlist = $this -> presentDao -> getAll();
        $this -> view -> assign("presents", $presentlist -> getItems());
		$success = null;
		if(!empty($this -> request['get']['success'])) {
			$success = EscapeHelper::escape($this -> request['get']['success'], EscapeHelper::TARGET_STRING);
		}
        $isErrorPresent = false;
        $isChangePresent = false;
        if (!empty($success) && ($success == "createPresent" || $success == "editPresent" || $success == "deletePresent")) {
            $args = EscapeHelper::escape($this -> request['get']['args'], EscapeHelper::TARGET_STRING);
            $parameter = base64_decode($args);
            list($paramPresentId, $paramResult) = split("&", $parameter);
            $presentId = EscapeHelper::escape(str_replace("presentId=", "", $paramPresentId), EscapeHelper::TARGET_NUMBER);
            if ($success == "createPresent") {
                $present = $this -> presentDao -> getById($presentId);
                $isChangePresent = true;
                $this -> view -> assign("infomessage", $this -> messageResolver -> getMessage("adminpresenttable_create_present", $present -> getTitle()));
            } else if ($success == "editPresent") {
                $present = $this -> presentDao -> getById($presentId);
                $isChangePresent = true;
                $this -> view -> assign("infomessage", $this -> messageResolver -> getMessage("adminpresenttable_edit_present", $present -> getTitle()));
            } else if ($success == "deletePresent") {
                $result = EscapeHelper::escape(str_replace("result=", "", $paramResult), EscapeHelper::TARGET_STRING);
                if ($result == 1) {
                    $isChangePresent = true;
                    $this -> view -> assign("infomessage", $this -> messageResolver -> getMessage("adminpresenttable_delete_present", $presentId));
                } else {
                    $isErrorPresent = true;
                    $this -> view -> assign("errormessage", $this -> messageResolver -> getMessage("adminpresenttable_delete_present_error", $presentId));
                }
            }
        }
        $this -> view -> assign("changePresent", $isChangePresent);
        $this -> view -> assign("errorPresent", $isErrorPresent);
    }
    /**
     * Display Content
     * @return type
     */
    public function display() {
        $this -> view -> setTemplate("backend_presenttable");
        $this -> view -> assign("view", "list");
        $this -> view -> assign("messageResolver", $this -> messageResolver);
        return $this -> view -> loadTemplate();
    }

}