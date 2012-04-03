<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TelefonoValidation
 *
 * @author Kassel
 * @date 07-oct-2011 
 */
class TelefonoValidation extends BaseValidation{
    public function isValid(&$errors){
        if(!preg_match('/^[679]{1}\d{8}/', $this->form)){
            
            $errors++;
            Data::$ERROR[][$this->getFormName()]=$this->val["message"];
        }
        
    }
}

?>
