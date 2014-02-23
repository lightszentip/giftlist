<?php

session_start();
require ("config/config.php");

if (file_exists("../config/custom-config.php")) {
    include ("templates/error.php");
} else {
    // show current step
    $nextStep = "introduction";
    if (isset($_POST['nextStep'])) {
        $nextStep = $_POST['nextStep'];
    }

    // define vars
    $step = $nextStep;
    $header = $config['header'];
    $product = $introduction["product"];

    $progress = 0;

    include ($nextStep . ".php");
    include ("templates/footer.php");
}
