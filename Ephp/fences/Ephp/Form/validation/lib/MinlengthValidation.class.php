<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MinlengthValidation
 *
 * @author Kassel
 * @date 07-oct-2011 
 */
class MinlengthValidation extends BaseValidation{
    public function __construct() {
        parent::__construct();
    }
    public function isValid(&$errors)
    {        
        if((strlen($this->form)<$this->val["value"])){
            $errors++;
            Data::$ERROR[][$this->getFormName()]=$this->val["message"];
        }
        
    }
}

?>
