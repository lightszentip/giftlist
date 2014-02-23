<?php

interface InterfaceTemplateResolver {

    /**
     * get result with content of template
     */
    public function getResult();

    /**
     * get template engine
     */
    public function getTemplateEngine();
}

?>