<?php

require_once ('./classes/loader.php');

/**
 * Get Controller
 */
class RouteFactory {

    private $securityService = SECURITY_CLASS;
    private $adminController = array("admin/present/create" => "ControllerCreateEditPresent",
        "admin/present/edit" => "ControllerCreateEditPresent",
        "admin/present/delete" => "ControllerDeletePresent",
        "admin/settings/maintenance" => "ControllerMaintenanceSettings",
        "admin" => "ControllerAdminStartpage",
        "admin/settings/all" => "ControllerSettings",
        "user/create" => "ControllerCreateUser",
        "user/profile" => "ControllerProfile",
    );
    private $defaultController = array("present/waehlen" => "ControllerUsePresent",
        "present/share" => "ControllerPresentShare",
        "present/release" => "ControllerReleasePresent",
        "present/view" => "ControllerPresentDetailView",
        "register" => "ControllerRegister",
        "resetpassword" => "ControllerResetPassword",
    );
    private $security;
    private $login;

    function __construct() {
        $this->login = new $this->securityService();
        $this->security = $this->login->getSecurityModel();
    }

    function getController($getRequest, $postRequest, $jdbcTemplate) {
        $mapping = $this->getMapping($getRequest);
        $request = array("get" => $getRequest, "post" => $postRequest);
        if ($mapping == 'login') {
            return new ControllerLogin($request, $this->login, "admin");
        } else if ($mapping == 'logout') {
            return new ControllerLogout($this->login);
        }
        $resultController = null;
        if (!array_key_exists($mapping, $this->adminController)) {
            $resultController = $this->getNoLoginController($request, $mapping, $jdbcTemplate);
        } else {
            // We've been requested to log in
            if ($this->security->isSignIn()) {
                $resultController = $this->getLoginController($request, $mapping, $jdbcTemplate);
            } else {
                $resultController = new ControllerLogin($request, $this->login, $mapping);
            }
        }
        if ($resultController == null) {
            throw new Exception();
        }
        return $resultController;
    }

    private function getMapping($getRequest) {
        $mapping = "";
        if (isset($getRequest['mapping'])) {
            $mapping = htmlspecialchars($getRequest['mapping']);
        } else if (empty($mapping) && $this->security->isSignIn()) {
            $mapping = "admin";
        }
        return $mapping;
    }

    private function getLoginController($request, $mapping, $jdbcTemplate) {
        if (array_key_exists($mapping, $this->adminController)) {
            return new $this->adminController[$mapping]($request, $jdbcTemplate, $this->login);
        } else if ($mapping == "admin/settings/maintenance/active") {
            return new ControllerMaintenanceSwitch($jdbcTemplate, 1);
        } else if ($mapping == "admin/settings/maintenance/inactive") {
            return new ControllerMaintenanceSwitch($jdbcTemplate, 0);
        }
    }

    private function getNoLoginController($request, $mapping, $jdbcTemplate) {
        if (MAINTENANCE && !$this->security->isSignIn()) {
            return new ControllerMaintenance($jdbcTemplate);
        } else {
            if (empty($mapping)) {
                return new ControllerStartpage($request, $jdbcTemplate, $this->login);
            } else if (array_key_exists($mapping, $this->defaultController)) {
                return new $this->defaultController[$mapping]($request, $jdbcTemplate, $this->login);
            }
        }
    }

}
