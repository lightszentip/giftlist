<?php

$error = false;
$goToNextStep = false;
$database_var = filter_input(INPUT_POST, 'database', FILTER_SANITIZE_STRING);
if ($database_var != null && $database_var != false) {
    $database = $database_var;
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
    $prefix = filter_input(INPUT_POST, 'prefix', FILTER_SANITIZE_STRING);
    $host = filter_input(INPUT_POST, 'host', FILTER_SANITIZE_STRING);

    // check connection
    $connection = @mysql_connect($host, $username, $password);
    if ($connection) {
        $error = !mysql_select_db($database, $connection);
        @mysql_close($connestion);

        if (!$error) {
            // save settings in database config file
            // load template
            $template = file_get_contents("config/database_template.php");
            $template = str_replace("%%host%%", $host, $template);
            $template = str_replace("%%prefix%%", $prefix, $template);
            if (isset($_SESSION["ulogin"]) && $_SESSION["ulogin"] == true) {
                $template = str_replace("%%security_type%%", "UloginSecurity", $template);
            } else {
                $template = str_replace("%%security_type%%", "PhpLoginSecurity", $template);
            }
            $template = str_replace("%%username%%", $username, $template);
            $template = str_replace("%%password%%", $password, $template);
            $template = str_replace("%%database%%", $database, $template);
            $template = str_replace("%%filepath%%", str_replace('/setup/1foo1', '/', dirname(getenv('SCRIPT_FILENAME')) . '/1foo1'), $template);
            $randomString = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ$;%-_/(){}?&#+*:.,<>@"), 0, 50);
            $template = str_replace("%%randomstring%%", $randomString, $template);
            // write config file
            $dbFile = dirname(getenv('SCRIPT_FILENAME')) . "/" . $config['applicationPath'] . "setup/" . $config['database_file'];
            file_put_contents($dbFile, $template);
            $importFile = file_get_contents($config['import_file_finished']);
            $dbImportFile = dirname(getenv('SCRIPT_FILENAME')) . "/" . $config['applicationPath'] . $config['import_file'];
            file_put_contents($dbImportFile, str_replace("%%prefix%%", $prefix, $importFile));
            if (isset($_SESSION["ulogin"]) && $_SESSION["ulogin"] == true) {
                $importUserFile = file_get_contents("config/user_ulogin.sql");
            } else {
                $importUserFile = file_get_contents("config/user_phplogin.sql");
            }
            $dbImportUserFile = dirname(getenv('SCRIPT_FILENAME')) . "/" . $config['applicationPath'] . $config['import_file_sec'];
            file_put_contents($dbImportUserFile, str_replace("%%prefix%%", $prefix, $importUserFile));
            // save login in session for further use
            $_SESSION['db_host'] = $host;
            $_SESSION['db_user'] = $username;
            $_SESSION['db_pass'] = $password;
            $_SESSION['db_name'] = $database;
            $_SESSION['db_prefix'] = $prefix;
            // allow user to proceed
            $goToNextStep = true;
        } else {
            $error = mysql_error();
        }
    } else {
        $error = mysql_error();
    }
} else {
    if (isset($_SESSION['db_host'])) {
        $host = $_SESSION['db_host'];
        $username = $_SESSION['db_user'];
        $password = $_SESSION['db_pass'];
        $database = $_SESSION['db_name'];
        $prefix = $_SESSION['db_prefix'];
    } else {
        $database = "";
        $username = "";
        $password = "";
        $prefix = "";
        $host = "localhost";
    }
}
$progress = 75;
include ("templates/header.php");
include ("templates/database.php");
