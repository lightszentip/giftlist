<?php

/**
 * Helps to properly escape variables for different output types.
 *
 * @see http://www.janoszen.com/2012/04/16/proper-xss-protection-in-javascript-php-and-smarty/
 */
class EscapeHelper {

    /**
     * Escapes variables for HTML content. Does not support arrays.
     */
    const TARGET_HTML = 'html';

    /**
     * Escapes variables for string content. Does not support arrays.
     */
    const TARGET_STRING = 'string';

    /**
     * Escapes variables for number content. Does not support arrays.
     */
    const TARGET_NUMBER = 'number';

    /**
     * Escapes variables for number content. Does not support arrays.
     */
    const TARGET_BOOLEAN = 'boolean';

    /**
     * Exception throw helper function.
     *
     * @param mixed  $variable
     * @param string $target
     *
     * @throws Exception
     */
    protected static function typeError($variable, $target) {
        throw Exception('Variable of type ' . gettype($variable) . ' cannot be escaped for ' . $target);
    }

    /**
     * Escapes variables for different output targets.
     *
     * @param mixed  $variable
     * @param string $target     See self::TARGET_* for details.
     * @param string $encoding   The character encoding to use for HTML.
     *
     * @return mixed   escaped character sequence.
     *
     * @throws Exception   if $variable cannot be escaped
     *                     for the given target.
     */
    public static function escape($variable, $target, $encoding = 'UTF-8') {

        if (empty($variable)) {
            return null;
        }

        if (is_resource($variable)) {
            self::typeError($variable);
        }

        if (is_object($variable)) {
            $variable = (string) $variable;
        }

        switch ($target) {
            case self::TARGET_HTML :
                if (is_array($variable)) {
                    self::typeError($variable, $target);
                }
                return htmlspecialchars($variable, ENT_XHTML, 'UTF-8');
            case self::TARGET_BOOLEAN :
                if (is_array($variable)) {
                    self::typeError($variable, $target);
                }
                if (is_bool($variable)) {
                    return $variable;
                } else {
                    if (strtolower($variable) === "false" || $variable == 0) {
                        return false;
                    } else if (strtolower($variable) === "true" || $variable == 1) {
                        return true;
                    } else {
                        return false;
                    }
                }
            case self::TARGET_NUMBER :
                if (is_array($variable)) {
                    self::typeError($variable, $target);
                }
                if (is_numeric($variable) || is_float($variable) || is_double($variable) || is_float($variable) || is_long($variable) || is_int($variable)) {
                    return $variable;
                } else {
                    if (ctype_digit($variable) && (filter_var($variable, FILTER_VALIDATE_INT) || filter_var($variable, FILTER_VALIDATE_FLOAT))) {
                        return $variable;
                    }
                }
            case self::TARGET_STRING :
                if (is_array($variable)) {
                    $newValue = array();
                    foreach ($variable as $key => $value) {
                        $newValue[$key] = htmlentities((string) $value);
                    }
                    return $newValue;
                } else {
                    return htmlentities((string) $variable);
                }
            default :
                throw new Exception('Invalid escape target ' . $target);
        }
    }

}

?>