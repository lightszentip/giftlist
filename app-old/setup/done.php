<?php
$furtherInstructions = file_get_contents("config/done.html");
$template = file_get_contents($config['database_file']);
$configFile = dirname(getenv('SCRIPT_FILENAME')) . "/" . $config['applicationPath'] . $config['database_file_finished'];
file_put_contents($configFile, $template);
$progress = 100;
include ("templates/header.php");
include("templates/done.php");
