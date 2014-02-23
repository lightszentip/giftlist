<?php

function autoloadClassesLib($className) {
    $filename = APP_DIR . '/lib/classes/' . $className . '.php';
    if (is_readable($filename)) {
        require $filename;
    }
}

spl_autoload_register("autoloadClassesLib");
