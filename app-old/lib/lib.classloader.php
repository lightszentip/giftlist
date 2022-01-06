<?php

require_once ('escape.helper.php');
require_once ('util.helper.php');
if(SECURITY_CLASS == "ULoginSecurity") {
    require_once ('lib/sec/ULoginSecurity.php');
} else {
    require_once ('lib/sec/PhpLoginSecurity.php');
}

