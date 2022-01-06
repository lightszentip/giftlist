<?php

$eula = file_get_contents("config/license.txt");
$progress = 15;
include ("templates/header.php");
include("templates/eula.php");
