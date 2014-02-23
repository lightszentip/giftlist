<?php

require_once (APP_DIR . '/lib/i18n.class.php');

/**
 *
 */
class AppMessageResolverI18nImpl implements InterfaceMessageResolver {

    private $i18n;

    function __construct() {
        $langcache = 'tmp/langcache/';
        $langdir = 'lang/lang_{LANGUAGE}.ini';
        $langdefault = "de";
        $langprefix = "MessagesI18n";
        $this->i18n = new i18n($langdir, $langcache, $langdefault);
        $this->i18n->setPrefix($langprefix);
        $this->i18n->setForcedLang($langdefault);
        // force english, even if another user language is available
        $this->i18n->setSectionSeperator('_');
        $this->i18n->init();
    }

    public function getMessage($key, $args = null) {
        $message = constant("MessagesI18n::$key");
        if (!empty($args)) {
            if (is_array($args)) {
                $counter = 0;
                foreach ($args as $key => $value) {
                    $message = str_replace('_{' . $counter . '}_', $value, $message);
                    $counter++;
                }
            } else {
                $message = str_replace('_{0}_', $args, $message);
            }
        }
        return $message;
    }

}

?>
