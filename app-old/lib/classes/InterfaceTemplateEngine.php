<?php

interface InterfaceTemplateEngine {

    /**
     * get html 
     */
    public function generateHtml($templatePath, $templateLayoutPage, $vars, $fragementName);
}
