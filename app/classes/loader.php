<?php
function autoloadClassesController($className) {
    $filename = APP_DIR.'/classes/controller/' . $className . '.php';
    if (is_readable($filename)) {
        require $filename;
    }
}
function autoloadClassesView($className) {
    $filename = APP_DIR.'/classes/view/' . $className . '.php';
    if (is_readable($filename)) {
        require $filename;
    }
}
spl_autoload_register("autoloadClassesController");
spl_autoload_register("autoloadClassesView");

?>