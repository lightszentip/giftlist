<?php

class ControllerSettings implements InterfaceController {

    private $request = null;
    private $view = null;
    private $messageResolver = null;
    private $configDao = null;
    private $confModeKeyUrl = "conf_domain_url";
    private $confModeKeyEmailAddress = "conf_email_address";
    private $confModeKeyCodeLength = "conf_code_length";
    private $confModeKeyTemplate = "conf_template";
    private $confModeKeyLogMode = "conf_log_mode";
    private $confModeKeyAppName = "conf_app_name";
    private $confModeKeyAppAbbreviation = "conf_app_abbreviation";
    private $logModeArray = array('debug', 'info', 'warn', 'error', 'fatal');
    private $templateArray = array('style', 'themecolor');

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
            $logmode = EscapeHelper::escape($this->request['post']['logmode'], EscapeHelper::TARGET_STRING);
            $domainUrl = EscapeHelper::escape($this->request['post']['domainurl'], EscapeHelper::TARGET_STRING);
            $template = EscapeHelper::escape($this->request['post']['template'], EscapeHelper::TARGET_STRING);
            $emailAddress = EscapeHelper::escape($this->request['post']['emailaddress'], EscapeHelper::TARGET_STRING);
            $codelength = EscapeHelper::escape($this->request['post']['codelength'], EscapeHelper::TARGET_STRING);
            $appname = EscapeHelper::escape($this->request['post']['appname'], EscapeHelper::TARGET_STRING);
            $appabbreviation = EscapeHelper::escape($this->request['post']['appabbreviation'], EscapeHelper::TARGET_STRING);
            if (!filter_var($emailAddress, FILTER_VALIDATE_EMAIL) || HelperUtil::isNullOrEmptyString($emailAddress)) {
                $error->addErrorField("emailaddress", "error_settings_email");
            }
            if (!filter_var($domainUrl, FILTER_VALIDATE_URL) || HelperUtil::isNullOrEmptyString($domainUrl)) {
                $error->addErrorField("domainurl", "error_settings_url");
            }
            if (HelperUtil::isNullOrEmptyString($appname)) {
                $error->addErrorField("appname", "error_settings_appname");
            }
            if (HelperUtil::isNullOrEmptyString($appabbreviation)) {
                $error->addErrorField("appabbreviation", "error_settings_appabbreviation");
            }
            $isLogModeMatch = false;
            $isTemplateMatch = false;
            foreach ($this->logModeArray as $key => $value) {
                if ($logmode == $value) {
                    $isLogModeMatch = true;
                }
            }
            if (!$isLogModeMatch) {
                $error->addErrorField("logmode", "error_settings_logmode");
            }
            foreach ($this->templateArray as $key => $value) {
                if ($template == $value) {
                    $isTemplateMatch = true;
                }
            }
            if (!$isTemplateMatch) {
                $error->addErrorField("template", "error_settings_template");
            }
            if ($error->hasError()) {
                $this->view->assign("template", $template);
                $this->view->assign("logmode", $logmode);
                $this->view->assign("codelength", $codelength);
                $this->view->assign("emailaddress", $emailAddress);
                $this->view->assign("domainurl", $domainUrl);
                $this->view->assign("appname", $appname);
                $this->view->assign("appabbreviation", $appabbreviation);
            } else {
                $this->configDao->update($this->confModeKeyCodeLength, $codelength);
                $this->configDao->update($this->confModeKeyUrl, $domainUrl);
                $this->configDao->update($this->confModeKeyEmailAddress, $emailAddress);
                $this->configDao->update($this->confModeKeyLogMode, $logmode);
                $this->configDao->update($this->confModeKeyTemplate, $template);
                $this->configDao->update($this->confModeKeyAppAbbreviation, $appabbreviation);
                $this->configDao->update($this->confModeKeyAppName, $appname);
                $targetLocation = APP_URL . "?mapping=admin/settings/all&success=save";
                header("Location: $targetLocation");
            }
        } else {
            $config = $this->configDao->getAll();
            $this->view->assign("logmode", $config[$this->confModeKeyLogMode]);
            $this->view->assign("codelength", $config[$this->confModeKeyCodeLength]);
            $this->view->assign("emailaddress", $config[$this->confModeKeyEmailAddress]);
            $this->view->assign("template", $config[$this->confModeKeyTemplate]);
            $this->view->assign("domainurl", $config[$this->confModeKeyUrl]);
            $this->view->assign("appname", $config[$this->confModeKeyAppName]);
            $this->view->assign("appabbreviation", $config[$this->confModeKeyAppAbbreviation]);
        }
        if (isset($success) && $success == "save") {
            $this->view->assign("changesettings", $this->messageResolver->getMessage("settings_save"));
        } else {
            $this->view->assign("changesettings", false);
        }
        $this->view->assign("error", $error);
        $this->view->assign("logmodes", $this->logModeArray);
        $this->view->assign("templates", $this->templateArray);
    }

    public function display() {
        $this->view->setTemplate("backend_settings");
        $this->view->assign("messageResolver", $this->messageResolver);
        return $this->view->loadTemplate();
    }

}