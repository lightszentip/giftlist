<?php

class ControllerMaintenanceSwitch implements InterfaceController {

    private $configDao = null;
    private $status = null;
    
    private $confModeKeyMaintenance = "conf_maintenance_mode";

    public function __construct($jdbcTemplate, $status) {
        $this -> configDao = new ConfigDao($jdbcTemplate);
        $this ->status = $status;
    }

    public function process() {
        if($this->status == 1) {
            $statusTitle = $this -> configDao -> update($this->confModeKeyMaintenance,"true");
        } else if($this->status == 0) {
            $statusTitle = $this -> configDao -> update($this->confModeKeyMaintenance,"false");
        }
        $targetLocation = APP_URL . "?mapping=admin/settings/maintenance&success=".($this ->status == 1 ? "on" : "").($this ->status == 0 ? "off" : "");
        header("Location: $targetLocation");
    }

    public function display() {
    }


}