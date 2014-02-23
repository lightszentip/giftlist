<?php

$tests = array();

function add_test($dscr, $explain, $result) {
    global $tests;
    $tests[] = array(
        'dscr' => $dscr,
        'explain' => $explain,
        'result' => $result
    );
}

$goToNextStep = true;

// php version
$currentPhpVersion = phpversion();
$phpVersionOk = version_compare($currentPhpVersion, $requirements['phpVersion']) >= 0;
if (!$phpVersionOk) {
    $goToNextStep = false;
} else {
    $_SESSION['ulogin'] = false;
}
// extensions
$loadedExtensions = get_loaded_extensions();
foreach ($loadedExtensions as $key => $ext) {
    $loadedExtensions[$key] = strtolower($ext);
}
$showExtensions = array();

foreach ($requirements['extensions'] as $ext) {
    $isLoaded = in_array($ext, $loadedExtensions);
    $showExtensions[$ext] = $isLoaded;
    if (!$isLoaded) {
        $goToNextStep = false;
    }
}

// show requirements
foreach ($requirements as $key => $value) {
    $$key = $value;
}

if (isset($_SESSION['ulogin']) && $_SESSION['ulogin'] == true) {
    $dscr = 'PHP on this system supports Blowfish?';
    $explain = '';
    if ((CRYPT_BLOWFISH == 1) || SuhosinInstalled()) {
        $result = 'OK';
    } else {
        $result = 'Error';
        $goToNextStep = false;
    }
    add_test($dscr, $explain, $result);
}


$dscr = 'PHP session.auto_start disabled?';
$explain = '';
if (!ini_get('session.auto_start')) {
    $result = 'OK';
} else {
    $result = 'Error';
    $goToNextStep = false;
}
add_test($dscr, $explain, $result);

$dscr = 'Is PHP date.timezone set?';
$explain = ' Please set timezone! For germany you must set in php.ini date.timezone ="Europe/Berlin"';
if (ini_get('date.timezone') !== '') {
    $result = 'OK';
} else {
    $result = 'Error';
    $goToNextStep = false;
}
add_test($dscr, $explain, $result);

$dscr = '[SECRUITY] Is PHP register_globals disabled?';
$explain = 'If PHP register_globals is turned on, it might allow an attacker to inject and overwrite variables on the server.';
if (!ini_get('register_globals'))
    $result = 'OK';
else
    $result = 'Warning';
add_test($dscr, $explain, $result);

$dscr = '[SECRUITY] Is PHP session.use_only_cookies enabled?';
$explain = 'PHP should not be allowed to propagate session identifiers in URLs, because it is easier to manipulate than a cookie.';
if (ini_get('session.use_only_cookies'))
    $result = 'OK';
else
    $result = 'Warning';
add_test($dscr, $explain, $result);

$dscr = '[SECRUITY] Is PHP session.use_trans_sid disabled?';
$explain = 'PHP should not be allowed to rewrite form requests and URIs to contain your session ID. This is a security threat, amongst other disadvantages.';
if (!ini_get('session.use_trans_sid'))
    $result = 'OK';
else
    $result = 'Warning';
add_test($dscr, $explain, $result);

$dscr = '[SECRUITY] Is PHP session.cookie_httponly enabled?';
$explain = 'Enabling this will protect all your cookies from being read by user-side scripts.';
if (ini_get('session.cookie_httponly'))
    $result = 'OK';
else
    $result = 'Warning';
add_test($dscr, $explain, $result);

$dscr = '[SECRUITY] Is PHP session.hash_function enforced?';
$explain = 'To make session identifiers harder to guess set session.hash_function to a valid value other than \'0\'.';
if (ini_get('session.hash_function') != '0')
    $result = 'OK';
else
    $result = 'Warning';
add_test($dscr, $explain, $result);

$dscr = '[SECRUITY] Is PHP expose_php disabled?';
$explain = 'Your HTTP server should not explicitly advertise that it is running PHP.';
if (!ini_get('expose_php'))
    $result = 'OK';
else
    $result = 'Warning';
add_test($dscr, $explain, $result);
$progress = 30;
include ("templates/header.php");
include("templates/requirements.php");
?>