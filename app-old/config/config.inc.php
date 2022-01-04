<?php
require_once ('custom-config.php');
define("TEMPLATE_PATH", './tpl/');
define("TEMPLATE_PATH_BACKEND", './tpl/backend/');
define("DB_URL_STRING",DB_TYPE.':host='.DB_SERVER.';dbname='.DB_NAME);

require_once (APP_DIR.'/lib/lib.autoloader.php');
require_once (APP_DIR.'/classes/dao/ConfigDao.php');

$databaseConnectionModel = new DatabaseConnectionModel(DB_NAME, DB_SERVER, DB_USER, DB_PW, DB_TYPE, "3306");
$jdbcTemplate = AppFactory::getJdbcTemplate($databaseConnectionModel);
$configDao = new ConfigDao($jdbcTemplate);
$config = $configDao->getAll();

define("APP_URL", $config['conf_domain_url']);
define("APP_VERSION", $config['conf_version']);
define("APP_URL_URL", str_replace("://","",substr(APP_URL, stripos(APP_URL, "://"))));
define("APP_DOMAIN", substr(APP_URL_URL, 0,stripos(APP_URL_URL, "/")));
define("PRESENT_EMAIL_REPLY", $config['conf_email_address']);
define("PRESENT_EMAIL_FROM", PRESENT_EMAIL_REPLY);
define("PRESENT_CODE_LENGTH_ADD", $config['conf_code_length']);
define("LOG_MODE", ''.$config['conf_log_mode'].'');
define("TEMPLATE_STYLE", ''.$config['conf_template'].'');
define("APP_ABBREVIATION", ''.$config['conf_app_abbreviation'].'');
define("APP_NAME", ''.$config['conf_app_name'].'');

if($config['conf_debug'] === 'false') {
    define("IS_DEBUG", false);//TODO DB Config
}  else {
    define("IS_DEBUG", true);//TODO DB Config
}
if($config['conf_maintenance_mode'] === 'false') {
    define("MAINTENANCE", false);//DB Config
}  else {
    define("MAINTENANCE", true);//DB Config
}
define('UL_DEBUG', IS_DEBUG);