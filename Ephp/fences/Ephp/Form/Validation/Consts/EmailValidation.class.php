<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of EmailValidation
 *
 * @author Kassel
 * @date 07-oct-2011 
 */
class EmailValidation extends BaseValidation {
    
    public function isValid(&$errors) {
        if(!preg_match('/\b[\w\.-]+@[\w\.-]+\.\w{2,4}\b/i', $this->form)){
            $errors++;
            Data::$ERROR[][$this->getFormName()]=$this->val["message"];
        }
    }
}

?>
