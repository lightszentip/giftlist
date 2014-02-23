<?php

/**
 * Interfaces
 */
/* require_once ('interfaceAppDebugger.php');
  require_once ('interfaceJdbcTemplate.php');
  require_once ('interfaceAppLogger.php');
  require_once ('interfaceTemplateEngine.php');
  require_once ('interfaceMessageResolver.php'); */
/**
 * Implements
 */
/* require_once ('appLoggerKLoggerImpl.php');
  require_once ('appDebuggerKintImpl.php');
  require_once ('appJdbcTemplateMedooImpl.php');
  require_once ('appTemplateEngineRainImpl.php');
  require_once ('appMessageResolverI18nImpl.php'); */

/**
 * Other Libs
 */
//require_once ('templatePack.php');
/**
 *
 */
class AppFactory {

    private static $messageResolver = null;

    static function getLogger($logLevel) {
        return new AppLoggerKLoggerImpl($logLevel);
    }

    static function getDebugger($isDebug = false) {
        return new AppDebuggerKintImpl($isDebug);
    }

    static function getTemplateEngine($path) {
        return new AppTemplateEngineRainImpl($path);
    }

    static function getJdbcTemplate(DatabaseConnectionModel $databaseConnectionModel) {
        return new AppJdbcTemplateMedooImpl($databaseConnectionModel, DB_PREFIX);
    }

    static function getMessageResolver() {
        if (empty(self::$messageResolver)) {
            self::$messageResolver = new AppMessageResolverI18nImpl();
        }
        return self::$messageResolver;
    }

}

?>