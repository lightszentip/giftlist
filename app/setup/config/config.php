<?php

$config['header'] = "Install Wizard Presentlist";
$config['applicationPath'] = "../";
//$config['database_file'] = "config/custom-config.php";
$config['import_file_finished'] = "tmp/import.sql";
$config['import_file'] = "setup/" . $config['import_file_finished'];
$config['import_file_sec_finished'] = "tmp/import_sec.sql";
$config['import_file_sec'] = "setup/" . $config['import_file_sec_finished'];

$config['database_file'] = "tmp/custom-config.php";
$config['database_file_finished'] = "config/custom-config.php";


// INTRODUCTION
$introduction = array();
$introduction["product"] = "Presentlist (PLAPP)";
$introduction["productVersion"] = "0.9.1";
$introduction["company"] = "";

// SERVER REQUIREMENTS
$requirements = array();
$requirements["phpVersion"] = "5.3.7";
$requirements["phpVersionUlogin"] = "5.2.0";
$requirements["extensions"] = array("mysql", "pcre", "pdo");

// FILE PERMISSIONS
// r = readable, w = writable, x = executable
$filePermissions = array();
$filePermissions["config"] = "rw";
$filePermissions["tmp"] = "rw";
$filePermissions["tmp/langcache"] = "rw";
$filePermissions["tmp/templatecache"] = "rw";
$filePermissions["log"] = "rw";
$filePermissions["setup/tmp"] = "rw";
