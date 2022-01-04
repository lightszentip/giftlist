<?php

if (version_compare(PHP_VERSION, '5.5.0', '<')) {
    // if you are using PHP 5.3 or PHP 5.4 you have to include the password_api_compatibility_library.php
    // (this library adds the PHP 5.5 password hashing functions to older versions of PHP)
    require_once('php-login-advanced/libraries/password_compatibility_library.php');
}
// include the config
require_once('php-login-advanced/config/config.php');

// include the to-be-used language, english by default. feel free to translate your project and include something else

// include the PHPMailer library
require_once('php-login-advanced/libraries/PHPMailer.php');

// load the login class
require_once('php-login-advanced/classes/Login.php');

// load the registration class
require_once('php-login-advanced/classes/Registration.php');

class PhpLoginSecurity implements InterfaceSecurity {

    private $login;
    private $register;

    public function __construct() {
        $this->login = new Login();
        if (isset($_POST["login"])) {
            if (filter_has_var(INPUT_POST, "sphvp")) {
                $secure = $_SESSION['secure'];
                if ($secure != null) {  
                    if (!$secure["expire"] > time() || !$secure["code"] == filter_input(INPUT_POST, "sphvp")) {
                        //not secure
                        $this->login->doLogout();
                    } else {
                        unset($secure);
                        $_SESSION['secure'] = null;
                    }
                }
            } else {
                //not secure
                $this->login->doLogout();
            }
        }
    }

    public function isAppLoggedIn() {
        return $this->login->isUserLoggedIn();
    }

    public function getSecurityModel() {
        if ($this->isAppLoggedIn()) {
            return new SecurityModel(true, $this->login->getUsername(), array(), $_SESSION["user_email"]);
        } else {
            return new SecurityModel(false, null, array(), null);
        }
    }

    public function appLogout() {
        $this->login->doLogout();
    }

    public function appLoginRequest($target) {
        if ($this->isAppLoggedIn()) {
            header("Location: $target");
        } else {
            return true;
        }
    }

    public function getLoginView() {
        return "php_login";
    }

    public function getProfilView() {
        return "php_profil";
    }

    public function getLoginViewVars() {
        $sphvp = array("code" => hash("sha512", substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ$;%-_/(){}?&#+*:.,<>@"), 0, 50)), "expire" => (time() + 900));
        $_SESSION['secure'] = $sphvp;
        return array("login" => $this->login, "sphvp" => $sphvp["code"]);
    }

    public function getProfilViewVars() {
        return array("login" => $this->login);
    }

    public function getRegisterView() {
        return "php_create";
    }

    public function getRegisterViewVars() {
        return array("registration" => $this->register);
    }

    public function processRegister() {
        $this->register = new Registration();
    }

    public function processEditProfil() {
        $this->login->editUserName(filter_input(INPUT_POST, "user_name"));
        $this->login->editUserEmail(filter_input(INPUT_POST, "user_email"));
    }

    public function processEditPassword() {
        $user_password_old = filter_input(INPUT_POST, "user_password_old");
        $user_password_new = filter_input(INPUT_POST, "user_password_new");
        $user_password_repeat = filter_input(INPUT_POST, "user_password_repeat");
        $this->login->editUserPassword($user_password_old, $user_password_new, $user_password_repeat);
    }

    public function resetLinkIsValid() {
        return $this->login->passwordResetLinkIsValid();
    }

    public function getResetView() {
        return "php_reset";
    }

    public function getResetConfirmView() {
        return "php_reset_confirm";
    }

    public function setPasswordResetDatabaseTokenAndSendMail() {
       return $this->login->setPasswordResetDatabaseTokenAndSendMail(filter_input(INPUT_POST, "user_name"));
    }

    public function editNewPassword() {
        $this->login->editNewPassword(filter_input(INPUT_POST, "user_name"), filter_input(INPUT_POST, "user_password_reset_hash"), filter_input(INPUT_POST, "user_password_new"), filter_input(INPUT_POST, "user_password_repeat"));
        return $this->login->passwordResetWasSuccessful();
    }

    public function checkIfEmailVerificationCodeIsValid() {
        $this->login->checkIfEmailVerificationCodeIsValid(filter_input(INPUT_GET, "user_name"), filter_input(INPUT_GET, "verification_code"));
    }

}
