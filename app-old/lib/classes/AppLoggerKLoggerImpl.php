<?php

require_once APP_DIR . '/lib/kLogger/KLogger.php';

/**
 * 
 */
class AppLoggerKLoggerImpl implements InterfaceAppLogger {

    private $log;

    /**
      const EMERG  = 0;  // Emergency: system is unusable
      const ALERT  = 1;  // Alert: action must be taken immediately
      const CRIT   = 2;  // Critical: critical conditions
      const ERR    = 3;  // Error: error conditions
      const WARN   = 4;  // Warning: warning conditions
      const NOTICE = 5;  // Notice: normal but significant condition
      const INFO   = 6;  // Informational: informational messages
      const DEBUG  = 7;  // Debug: debug messages
     */
    function __construct($logLevel = "debug") {
        $levelNumber = 0;
        switch (strtolower($logLevel)) {
            case 'debug':
                $levelNumber = 7;
                break;
            case 'info':
                $levelNumber = 6;
                break;
            case 'warn':
                $levelNumber = 4;
                break;
            case 'error':
                $levelNumber = 3;
                break;
            case 'fatal':
                $levelNumber = 1;
                break;
        }
        $this->log = KLogger::instance(dirname(__FILE__) . "/../log/", $levelNumber);
    }

    function info($msg, $obj = null) {
        if (is_null($obj)) {
            $this->log->logInfo($msg);
        } else {
            $this->log->logInfo($msg, $obj);
        }
    }

    function warn($msg, $obj = null) {
        if (is_null($obj)) {
            $this->log->logWarn($msg);
        } else {
            $this->log->logWarn($msg, $obj);
        }
    }

    function error($msg, $obj = null) {
        if (is_null($obj)) {
            $this->log->logError($msg);
        } else {
            $this->log->logError($msg, $obj);
        }
    }

    function fatal($msg, $obj = null) {
        if (is_null($obj)) {
            $this->log->logCrit($msg);
        } else {
            $this->log->logCrit($msg, $obj);
        }
    }

}

?>