<?php

/**
 * Description of BaseValidation
 *
 * @author Kassel
 * @date 07-oct-2011 
 */
class BaseValidation {
    private $valid=FALSE;
    public $key, $val, $form, $formname;
    public function __construct(){
        
    }
    public function setKey($key){$this->key=$key;}
    public function setValue($val){$this->val=$val;}
    public function getValue(){return $this->val;}
    public function setForm($form){$this->form=$form;}
    public function getForm(){return $this->form;}
    public function setFormName($val){$this->formname=$val;}
    public function getFormName(){return $this->formname;}
    protected function setValid($val){$this->valid=$val;}
    protected function getValid(){return $this->valid;}
    public function isValid(&$errors){return $this->valid;}
    
}

?>
