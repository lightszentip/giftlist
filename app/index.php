<?php

header('Content-Type: text/html; charset=UTF-8');
if (file_exists("setup")) {
    if (!file_exists("config/custom-config.php")) {
        header("Location:setup/");
    } else {
        header("Location:setup/");
    }
} else {

    require_once ('config/config.inc.php');
    require_once ('lib/lib.classloader.php');
    require_once ('./classes/dao/PresentDao.php');
    require_once ('./classes/model/securityModel.php');
    require_once ('./classes/routeFactory.php');
    require_once ('./classes/model/presentModel.php');
    require_once ('./classes/model/errorModel.php');

    if (IS_DEBUG) {
        error_reporting(E_ALL);
        ini_set("display_errors", 1);
    }
    // Start a secure session if none is running
    $appDebugger = AppFactory::getDebugger(IS_DEBUG);
    if (SECURITY_CLASS == "ULoginSecurity") {
        if (!sses_running()) {
            sses_start();
        }
        $appDebugger->debug($_SESSION);
    } else {
        require_once('./lang/sec_de.php');
    }
    $appDebugger->trace();
    $appLogger = AppFactory::getLogger(LOG_MODE);
    // Controller erstellen
    $route = new RouteFactory();
    $controller = $route->getController(@$_GET, @$_POST, $jdbcTemplate);
    $controller->process();

    echo $controller->display();
}
?>