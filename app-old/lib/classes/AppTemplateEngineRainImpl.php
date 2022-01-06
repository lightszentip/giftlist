<?php

require_once (APP_DIR . '/lib/rain.tpl.class.php');

raintpl::configure("cache_dir", "tmp/templatecache/");

class AppTemplateEngineRainImpl implements InterfaceTemplateEngine {

    private $templateEngine;
    private $templatePath;

    public function __construct($templatePath) {
        raintpl::configure("tpl_dir", $templatePath);
        $this->templateEngine = new RainTPL;
        $this->templatePath = $templatePath;
    }

    public function generateHtml($templateLayoutPage, $vars, $fragementName, $outputHtml = false) {
        $template = clone $this->templateEngine;
        $template->assign($vars);
        $file = $this->templatePath . $templateLayoutPage . '.html';
        if (file_exists($file)) {
            // $html = $this -> templateEngine -> draw($templateLayoutPage, true);
            $html = $template->draw($templateLayoutPage, true);
            if ($outputHtml) {
                return $html;
            } else {
                return array($fragementName => $html);
            }
        } else {
            // Template-File existiert nicht-> Fehlermeldung.
            if ($outputHtml) {
                return "";
            } else {
                return array($fragementName => "");
            }
        }
    }

}

?>