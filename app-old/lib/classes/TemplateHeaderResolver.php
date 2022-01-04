<?php

class TemplateHeaderResolver extends TemplateDecorator {

    public function setTitle($title) {
        parent::assign("title", $title);
    }

    public function setStartpageLink($link) {
        parent::assign("startpagelink", $link);
    }

    public function setSubtitle($subtitle) {
        parent::assign("subtitle", $subtitle);
    }

}