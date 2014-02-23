<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class SecurityModel {

    private $signIn;
    private $userName;
    private $roles;
    private $email;

    function __construct($signIn, $userName, $roles, $email) {
        $this->signIn = $signIn;
        $this->userName = $userName;
        $this->roles = $roles;
        $this->email = $email;
    }

    function isSignIn() {
        if($this->signIn != null) {
            return $this->signIn;
        }
        return false;
    }

    function getUserName() {
        return $this->userName;
    }

    function getRoles() {
        return $this->roles;
    }
    
    function getEmail() {
        return $this->email;
    }

}
