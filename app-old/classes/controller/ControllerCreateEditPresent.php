<?php

class ControllerCreateEditPresent implements InterfaceController {

    private $request = null;
    private $view = null;
    private $messageResolver = null;
    private $presentDao = null;

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
        $this->presentDao = new PresentDao($jdbcTemplate);
    }

    /**
     * 
     */
    public function process() {
        $isNew = null;
        if (!empty($this->request['post']['checknew'])) {
            $isNew = EscapeHelper::escape($this->request['post']['checknew'], EscapeHelper::TARGET_STRING);
        }
        $error = new ErrorModel();
        $isError = false;
        $isEdit = false;
        if ($isNew == "true") {
            $title = EscapeHelper::escape($this->request['post']['title'], EscapeHelper::TARGET_STRING);
            $description = EscapeHelper::escape($this->request['post']['description'], EscapeHelper::TARGET_STRING);
            $imagePath = EscapeHelper::escape($this->request['post']['imagePath'], EscapeHelper::TARGET_STRING);
            $links = EscapeHelper::escape($this->request['post']['links'], EscapeHelper::TARGET_STRING);
            if (HelperUtil::isNullOrEmptyString($title)) {
                $error->addErrorField("title", "error_present_create_empty_title");
            } else {
                if (strlen($title) > 50) {
                    $error->addErrorField("title", "error_present_create_size_title");
                }
            }
            if (!empty($imagePath)) {
                if (!$this->str_starts_with($imagePath, "http")) {
                    $imagePath = "http://" . $imagePath;
                }
                if (!filter_var($imagePath, FILTER_VALIDATE_URL)) {
                    $error->addErrorField("title", "error_present_create_invalid_imagepath");
                }
            }
            if (!empty($description) && strlen($description) > 1200) {
                $error->addErrorField("description", "error_present_create_size_description");
            }
            if (!empty($links)) {

                function notEmpty($var) {
                    // Gibt zurück, ob der Eingabewert gerade ist
                    return (!(!isset($var) || trim($var) === '' || empty($var)));
                }

                $links = array_filter($links, "notEmpty");
            }
            if (count($links) == 0) {
                $links = null;
            }
            $present = new PresentModel();
            $present->setTitle($title);
            $present->setDescription($description);
            $present->setImagePath($imagePath);
            $present->setLinks($links);
            if ($error->hasError()) {
                $editId = EscapeHelper::escape($this->request['post']['editId'], EscapeHelper::TARGET_NUMBER);
                if (!empty($editId)) {
                    $present->setId($editId);
                }
                $this->view->assign("present", $present);
            } else {
                $editId = EscapeHelper::escape($this->request['post']['editId'], EscapeHelper::TARGET_NUMBER);
                if (!empty($editId)) {
                    $present->setId($editId);
                    $id = $this->presentDao->update($present);
                    if ($id != null) {
                        $targetLocation = APP_URL . "?mapping=admin&success=editPresent&args=" . base64_encode("presentId=$id");
                        header("Location: $targetLocation");
                    } else {
                        $error->addErrorField("present", $this->messageResolver->getMessage("error_present_create_db"));
                        $this->view->assign("present", $present);
                    }
                } else {
                    $id = $this->presentDao->createPresent($present);
                    if ($id != null) {
                        $targetLocation = APP_URL . "?mapping=admin&success=createPresent&args=" . base64_encode("presentId=$id");
                        header("Location: $targetLocation");
                    } else {
                        $error->addErrorField("present", $this->messageResolver->getMessage("error_present_create_db"));
                        $this->view->assign("present", $present);
                    }
                }
            }
        } else {
            //edit ?
            $presendId = EscapeHelper::escape($this->request['get']['id'], EscapeHelper::TARGET_NUMBER);
            if (!empty($presendId)) {
                $present = $this->presentDao->getById($presendId);
                if ($present != null && $present->getStatus() != 1) {
                    $this->view->assign("present", $present);
                    $isEdit = true;
                } else {
                    $this->view->assign("present", new PresentModel());
                    $isError = true;
                }
            } else {
                $this->view->assign("present", new PresentModel());
            }
        }
        $this->view->assign("isError", $isError);
        $this->view->assign("isEdit", $isEdit);
        $this->view->assign("error", $error);
    }

    /**
     * 
     * @return type
     */
    public function display() {
        $this->view->setTemplate("backend_createeditpresent");
        $this->view->assign("messageResolver", $this->messageResolver);
        return $this->view->loadTemplate();
    }

    private function str_starts_with($haystack, $needle) {
        return substr_compare($haystack, $needle, 0, strlen($needle)) === 0;
    }

    private function str_ends_with($haystack, $needle) {
        return substr_compare($haystack, $needle, -strlen($needle)) === 0;
    }

}

?>