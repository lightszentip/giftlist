<?php

class TemplateGenerateLayout {

    private $vars = array();
    private $path;
    private $templateLayoutPage;
    private $templateResolver;

    public function __construct(InterfaceTemplateResolver $templateResolver, $templateLayoutPage) {
        $this->templateLayoutPage = $templateLayoutPage;
        $this->templateResolver = $templateResolver;
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
        return $this->templateResolver->getTemplateEngine()->generateHtml($this->templateLayoutPage, array_merge($this->vars, $this->templateResolver->getResult()), null, true);
    }

}

?>