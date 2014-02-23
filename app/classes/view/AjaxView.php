<?php

class AjaxView {

    // Name des Templates, in dem Fall das Standardtemplate.
    private $templatePage = 'content';

    private $template = '';

    /**
     * Enthält die Variablen, die in das Template eingebetet
     * werden sollen.
     */
    private $templateVar = array();

    public function __construct($templatePath = TEMPLATE_PATH) {
        $this -> template = new TemplateResolver(AppFactory::getTemplateEngine($templatePath));
    }

    /**
     * Ordnet eine Variable einem bestimmten Schl&uuml;ssel zu.
     *
     * @param String $key Schlüssel
     * @param String $value Variable
     */
    function assign($variable, $value = null) {
        if (is_array($variable))
            $this -> templateVar += $variable;
        else
            $this -> templateVar[$variable] = $value;
    }

    /**
     * Setzt den Namen des Templates.
     *
     * @param String $template Name des Templates.
     */
    public function setTemplate($templatePage = 'content') {
        $this -> templatePage = $templatePage;
    }

    /**
     * Das Template-File laden und zurückgeben
     *
     * @param string $tpl Der Name des Template-Files (falls es nicht vorher
     * 						über steTemplate() zugewiesen wurde).
     * @return string Der Output des Templates.
     */
    public function loadTemplate() {
        $contentTemplate = new TemplateContentResolver($this->template, "content", $this -> templatePage);
        $contentTemplate -> assign($this -> templateVar);
        $layout = new TemplateGenerateLayout($contentTemplate, "ajax");
        return $layout -> getHtml();
    }

}
?>