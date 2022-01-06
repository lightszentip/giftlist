<?php

class TemplateNavigationResolver extends TemplateDecorator {

    public function addNavItem($link, $title, $disable = false) {
        parent::assignArray("navigation", array('link' => $link, 'title' => $title, 'disable' => $disable));
        ;
    }

}

?>