<?php

class BackendView {

    // Name des Templates, in dem Fall das Standardtemplate.
    private $templatePage = 'content';
    private $template = '';
    private $security;

    /**
     * Enthält die Variablen, die in das Template eingebetet
     * werden sollen.
     */
    private $templateVar = array();

    public function __construct(SecurityModel $security = null) {
        $this->template = new TemplateResolver(AppFactory::getTemplateEngine(TEMPLATE_PATH_BACKEND));
        $this->security = $security;
    }

    /**
     * Ordnet eine Variable einem bestimmten Schl&uuml;ssel zu.
     *
     * @param String $key Schlüssel
     * @param String $value Variable
     */
    function assign($variable, $value = null) {
        if (is_array($variable))
            $this->templateVar += $variable;
        else
            $this->templateVar[$variable] = $value;
    }

    /**
     * Setzt den Namen des Templates.
     *
     * @param String $template Name des Templates.
     */
    public function setTemplate($templatePage = 'content') {
        $this->templatePage = $templatePage;
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
        $contentTemplate = new TemplateContentResolver($this->template, "content", $this->templatePage);
        $contentTemplate->assign($this->templateVar);
        $navTemplate = new TemplateNavigationResolver($contentTemplate, "navigation", "backend_navigation");
        $navTemplate->assign("navToggle", $messageResolver->getMessage("navigation_toggle"));
        $navTemplate->assign("signin", $messageResolver->getMessage("navigation_signinas") . $this->security->getUserName());
        $navTemplate->assign("messageResolver", $messageResolver);
        if ($this->security->isSignIn()) {
            $navTemplate->addNavItem("?mapping=admin", $messageResolver->getMessage("navigation_home_admin"));
            $navTemplate->addNavItem("?mapping=admin/present/create", $messageResolver->getMessage("navigation_createpresent"));
            $navTemplate->addNavItem("?mapping=admin/settings/maintenance", $messageResolver->getMessage("navigation_maintenance_settings"));
            $navTemplate->addNavItem("?mapping=admin/settings/all", $messageResolver->getMessage("navigation_settings"));
            $navTemplate->addNavItem("?mapping=user/create", $messageResolver->getMessage("navigation_createuser"));
        } else {
            $navTemplate->addNavItem("?mapping=", $messageResolver->getMessage("navigation_frontend"));
        }
        $headerTemplate = new TemplateHeaderResolver($navTemplate, "header", "backend_header");
        $headerTemplate->setStartpageLink(APP_URL);
        $headerTemplate->setSubtitle($messageResolver->getMessage("application_subtitle"));
        $layout = new TemplateGenerateLayout($headerTemplate, "backendlayout");
        $layout->assign("messageResolver", $messageResolver);
        return $layout->getHtml();
    }

}

?>