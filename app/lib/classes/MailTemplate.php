<?php

class MailTemplate {

    private $templateLayoutPage;
    private $templateEngine;
    private $vars = array();

    public function __construct($templateLayoutPage, $templateEngine) {
        $this->templateLayoutPage = $templateLayoutPage;
        $this->templateEngine = $templateEngine;
    }

    public function assign($variable, $value = null) {
        if (is_array($variable))
            $this->vars += $variable;
        else
            $this->vars[$variable] = $value;
    }

    public function assignArray($name, $value = null) {
        $this->vars[$name][] = $value;
    }

    public function getHtml() {
        return $this->templateEngine->generateHtml($this->templateLayoutPage, $this->vars, null, true);
    }

}

?>