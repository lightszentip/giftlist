<?php

// Oberklasse aller Dekorierer
abstract class TemplateDecorator implements InterfaceTemplateResolver {

    private $vars = array();
    private $fragementName;
    private $templateLayoutPage;
    private $templateResolver;

    public function __construct(InterfaceTemplateResolver $templateResolver, $fragementName, $templateLayoutPage) {
        $this->fragementName = $fragementName;
        $this->templateLayoutPage = $templateLayoutPage;
        $this->templateResolver = $templateResolver;
    }

    /**
     * get template vars
     * @return array vars for template
     */
    protected function getVars() {
        return $this->vars;
    }

    /**
     * Set template vars
     * @param type $variable key for the value or a array with values
     * @param type $value value for the key (optional)
     */
    public function assign($variable, $value = null) {
        if (is_array($variable))
            $this->vars += $variable;
        else
            $this->vars[$variable] = $value;
    }

    public function assignArray($name, $value = null) {
        $this->vars[$name][] = $value;
    }

    public function getTemplateEngine() {
        return $this->templateResolver->getTemplateEngine();
    }

    public function getResult() {
        return $this->templateResolver->getResult() + $this->getTemplateEngine()->generateHtml($this->templateLayoutPage, $this->vars, $this->fragementName);
    }

}

?>