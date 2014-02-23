<?php

class ControllerMaintenanceSettings implements InterfaceController {

    private $request = null;
    private $view = null;
    private $messageResolver = null;
    private $configDao = null;
    private $confModeKeySubtitle = "conf_maintenance_mode_subtitle";
    private $confModeKeyTitle = "conf_maintenance_mode_title";
    private $confModeKeyMaintenance = "conf_maintenance_mode";

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
        $this->configDao = new ConfigDao($jdbcTemplate);
    }

    public function process() {
        $isNew = null;
        $success = null;
        if (!empty($this->request['post']['checknew'])) {
            $isNew = EscapeHelper::escape($this->request['post']['checknew'], EscapeHelper::TARGET_STRING);
        }
        if (!empty($this->request['get']['success'])) {
            $success = EscapeHelper::escape($this->request['get']['success'], EscapeHelper::TARGET_STRING);
        }
        $error = new ErrorModel();
        if ($isNew == "true") {
            $title = EscapeHelper::escape($this->request['post']['title'], EscapeHelper::TARGET_STRING);
            $content = EscapeHelper::escape($this->request['post']['content'], EscapeHelper::TARGET_STRING);
            if (!empty($title) && strlen($title) > 50) {
                $error->addErrorField("title", "error_maintenance_settings_size_title");
            }
            if (!empty($content) && strlen($content) > 255) {
                $error->addErrorField("content", "error_maintenance_settings_size_content");
            }
            if ($error->hasError()) {
                $this->view->assign("content", $content);
                $this->view->assign("title", $title);
            } else {
                $statusTitle = $this->configDao->update($this->confModeKeyTitle, $title);
                $statusSubtitle = $this->configDao->update($this->confModeKeySubtitle, $content);

                if ($statusSubtitle && $statusTitle) {
                    $targetLocation = APP_URL . "?mapping=admin/settings/maintenance&success=save";
                    header("Location: $targetLocation");
                } else {
                    $error->addErrorField("maintenance", $this->messageResolver->getMessage("error_maintenance_settings_db"));
                    $this->view->assign("content", $content);
                    $this->view->assign("title", $title);
                }
            }
        } else {
            $config = $this->configDao->getAll();
            $this->view->assign("title", $config[$this->confModeKeyTitle]);
            $this->view->assign("content", $config[$this->confModeKeySubtitle]);
        }
        if ($success == "save") {
            $this->view->assign("changemaintenance", $this->messageResolver->getMessage("maintenance_settings_save"));
        } else if ($success == "on") {
            $this->view->assign("changemaintenance", $this->messageResolver->getMessage("maintenance_settings_on"));
        } else if ($success == "off") {
            $this->view->assign("changemaintenance", $this->messageResolver->getMessage("maintenance_settings_off"));
        } else {
            $this->view->assign("changemaintenance", false);
        }
        $this->view->assign("modeStatus", $config[$this->confModeKeyMaintenance]);
        $this->view->assign("error", $error);
    }

    public function display() {
        $this->view->setTemplate("backend_maintenance_settings");
        $this->view->assign("messageResolver", $this->messageResolver);
        return $this->view->loadTemplate();
    }

}
