<?php

$error = false;
$goToNextStep = false;
$isErrorCodeLength = false;
$isErrorEmailAddress = false;
$isErrorDomainUrl = false;
$isErrorAppName = false;
$isErrorAppAbbreviation = false;

function IsNullOrEmptyString($variable) {
    return (!isset($variable) || trim($variable) === '' || empty($variable));
}
$domainUrl = filter_input(INPUT_POST, 'domainurl');
if (isset($domainUrl) && $domainUrl != false) {
    $emailAddress = filter_input(INPUT_POST, 'emailaddress');
    $codeLength = filter_input(INPUT_POST, 'codelength');
    $appabbreviation = filter_input(INPUT_POST, 'appabbreviation');
    $appname = filter_input(INPUT_POST, 'appname');
    $int_options = array("options" => array("min_range" => 0, "max_range" => 25));
    if (!filter_var($codeLength, FILTER_VALIDATE_INT, $int_options)) {
        $error = true;
        $isErrorCodeLength = true;
    }
    if (!filter_var($emailAddress, FILTER_VALIDATE_EMAIL) || IsNullOrEmptyString($emailAddress)) {
        $error = true;
        $isErrorEmailAddress = true;
    }
    if (!filter_var($domainUrl, FILTER_VALIDATE_URL) || $domainUrl === "" || IsNullOrEmptyString($domainUrl)) {
        $error = true;
        $isErrorDomainUrl = true;
    }
    if (IsNullOrEmptyString($appname)) {
        $error = true;
        $isErrorAppName = true;
    }
    if (IsNullOrEmptyString($appabbreviation)) {
        $error = true;
        $isErrorAppAbbreviation = true;
    }
    if (substr($domainUrl,-1) != "/") {
        $domainUrl = $domainUrl."/";
    }
    if (!$error) {
        // save settings in database config file
        // load template
        $template = file_get_contents("config/import.sql");
        $template = str_replace("%%domainurl%%", $domainUrl, $template);
        $template = str_replace("%%emailaddress%%", $emailAddress, $template);
        $template = str_replace("%%codelength%%", $codeLength, $template);
        $template = str_replace("%%appname%%", $appname, $template);
        $template = str_replace("%%appabbreviation%%", $appabbreviation, $template);
        $template = str_replace("%%version%%", $introduction["productVersion"], $template);
        // write import file
        $dbImportFile = dirname(getenv('SCRIPT_FILENAME')) . "/" . $config['applicationPath'] . $config['import_file'];
        file_put_contents($dbImportFile, $template);
        // allow user to proceed
        $goToNextStep = true;
    }
} else {
    $domainUrl = "";
    $emailAddress = "";
    $codeLength = 12;
    $appabbreviation = "";
    $appname = "";
}
$progress = 60;
include ("templates/header.php");
include ("templates/appconfig.php");
