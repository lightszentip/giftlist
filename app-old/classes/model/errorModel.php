<?php
class ErrorModel {
    private $errorFields;
    private $errorFieldMessage;
    private $isError = false;

    public function __construct() {
        $this->errorFields = array();
        $this->errorFieldMessage = array();
    }

    public function addErrorField($field, $msg) {
        $this->errorFields[] = $field;
        $this->errorFieldMessage[$field] = $msg;
        $this->isError = true;
    }

    public function hasErrors($field) {
        foreach ($this->errorFields as $key => $value) {
            if($value == $field) {
                return true;
            }
        }
        return false;
    }
    
    public function getMessage($field) {
        return $this->errorFieldMessage[$field];
    }
    
    public function hasError(){
        return $this->isError ;
    }

}
