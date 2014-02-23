<?php

interface InterfaceAppLogger {

    function info($msg, $obj = null);

    function warn($msg, $obj = null);

    function error($msg, $obj = null);

    function fatal($msg, $obj = null);
}

?>