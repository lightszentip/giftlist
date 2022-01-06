<?php

class FrontendView {

    // Name des Templates, in dem Fall das Standardtemplate.
    private $templatePage = 'content';

    private $template = '';

    /**
     * Enthält die Variablen, die in das Template eingebetet
     * werden sollen.
     */
    private $templateVar = array();

    public function __construct() {
        $this -> template = new TemplateResolver(AppFactory::getTemplateEngine(TEMPLATE_PATH));
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
        $messageResolver = AppFactory::getMessageResolver();
        $contentTemplate = new TemplateContentResolver($this->template, "content", $this -> templatePage);
        $contentTemplate -> assign($this -> templateVar);
        $navTemplate = new TemplateNavigationResolver($contentTemplate, "navigation", "navigation");
        $navTemplate -> assign("navToggle",$messageResolver->getMessage("navigation_toggle"));
        $navTemplate -> addNavItem("?mapping=", $messageResolver->getMessage("navigation_home")); 
        $navTemplate -> addNavItem("?mapping=present/release", $messageResolver->getMessage("navigation_changepresent"));
        $headerTemplate = new TemplateHeaderResolver($navTemplate, "header", "header");
        $headerTemplate -> setStartpageLink(APP_URL);
        $headerTemplate -> setSubtitle($messageResolver->getMessage("application_subtitle"));
        $layout = new TemplateGenerateLayout($headerTemplate, "layout");
        $layout->assign("footer",$messageResolver->getMessage("application_copyright"));
        $layout->assign("administrationlink","?mapping=admin");
        $layout->assign("administrationlinktext",$messageResolver->getMessage("navigation_admin"));
        return $layout -> getHtml();
    }

}
?>