<?php

include("helper.php");

function importFile($import, $errors) {
    $queries = array();
    PMA_splitSqlFile($queries, $import);

    foreach ($queries as $query) {
        if (!mysql_query($query['query'])) {
            $errors[] = "<b>" . mysql_error() . "</b><br>(" . substr($query['query'], 0, 200) . "...)";
        }
    }
}

$errors = array();
$goToNextStep = false;

$host = $_SESSION['db_host'];
$username = $_SESSION['db_user'];
$password = $_SESSION['db_pass'];
$database = $_SESSION['db_name'];

// connect to db
$con = mysql_connect($host, $username, $password);
mysql_select_db($database, $con);

// read import sql
$importFile = file_get_contents($config['import_file_finished']);
importFile($importFile, $errors);
$importSecFile = file_get_contents($config['import_file_sec_finished']);
importFile($importSecFile, $errors);

// close connection
mysql_close($con);
$progress = 90;
// show error
include ("templates/header.php");
include("templates/importSQL.php");
