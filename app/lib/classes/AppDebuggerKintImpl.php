<?php

require_once APP_DIR . '/lib/kint/Kint.class.php';

/**
 * 
 */
class AppDebuggerKintImpl implements InterfaceAppDebugger {

    private $isDebug = false;

    function __construct($isDebug = false) {
        $this->isDebug = $isDebug;
        if ($this->isDebug) {
            Kint::enabled($this->isDebug);
        }
    }

    function debug($debugVar) {
        $this->debugValue($debugVar, false);
    }

    function getDebug($debugVar) {
        return $this->debugValue($debugVar, true);
    }

    function debugServer() {
        $this->debugValue($_SERVER, false);
    }

    function trace() {
        if ($this->isDebug) {
            Kint::trace();
        }
    }

    private function debugValue($debugVar, $isReturn = false) {
        if ($this->isDebug) {
            if ($isReturn) {
                @Kint::dump($debugVar);
            } else {
                Kint::dump($debugVar);
            }
        }
    }

}

?>