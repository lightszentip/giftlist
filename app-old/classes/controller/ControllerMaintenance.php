<?php

class ControllerMaintenance implements InterfaceController {

    private $view = null;
    private $messageResolver = null;
    private $configDao = null;
    
    private $confModeKeySubtitle = "conf_maintenance_mode_subtitle";
    private $confModeKeyTitle = "conf_maintenance_mode_title";
    
    /**
     * 
     * @param type $jdbcTemplate
     */
    public function __construct($jdbcTemplate) {
        $this -> view = new FrontendView();
        $this -> messageResolver = AppFactory::getMessageResolver();
        $this -> configDao = new ConfigDao($jdbcTemplate);
    }

    public function process() {
        $this -> view -> assign("title", $this -> configDao->getByKey($this->confModeKeyTitle));
        $this -> view -> assign("subtitle", $this -> configDao->getByKey($this->confModeKeySubtitle));
    }

    public function display() {
        $this -> view -> setTemplate("maintenance");
        return $this -> view -> loadTemplate();
    }

}