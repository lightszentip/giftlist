<?php

interface InterfaceSecurity {

    /**
     * Check login status
     */
    public function isAppLoggedIn();
    
    
    /**
     * Get Security Model for sign in user
     */
    public function getSecurityModel();
    
    /**
     * logout
     */
    public function appLogout();
    
    /**
     * login by request
     */
    public function appLoginRequest($target);
    
    public function getLoginView();
    
    public function getLoginViewVars();
    
    public function processRegister();
    
    public function getRegisterView();
    
    public function getRegisterViewVars();
    
    public function processEditProfil();
    
    public function processEditPassword();
    
    public function getProfilViewVars();
    
    public function resetLinkIsValid();
    
    public function getResetView();
    
    public function getResetConfirmView();
    
    public function setPasswordResetDatabaseTokenAndSendMail();
    
    public function editNewPassword();
    
    public function checkIfEmailVerificationCodeIsValid();
    
}
