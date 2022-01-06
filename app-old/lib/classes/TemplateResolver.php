<?php

class TemplateResolver implements InterfaceTemplateResolver {

    private $templateEngine;

    public function __construct($templateEngine) {
        $this->templateEngine = $templateEngine;
    }

    public function getResult() {
        return array();
    }

    public function getTemplateEngine() {
        return $this->templateEngine;
    }

}

?>