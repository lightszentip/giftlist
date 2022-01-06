<?php

interface InterfaceController {

    /**
     * process controller method
     */
    public function process();

    /**
     * show the content
     *
     * @return String Content from application.
     */
    public function display();
}

?>