<?php
namespace Ephp\Form\lib;

class MyField{
    protected $html= '', $name = '', $form = '', $label = '', $default;
    private $error;
    public function __construct($name, $form){
        $this->name = $name;
        $this->form = $form;
    }
    public function setError($value){$this->error = $value;}
    public function getField(){return $this->html;}
    public function getLabel(){
        return '<label for="'.$this->form.'_'.$this->name.'">'.$this->label.'</label>';
    }
    public function label($name){$this->label = $name;}
    public function defaults($value){$this->default = $value;}
    public function getError(){return $this->error;}
    protected function getValue($val){
        return (isset($_POST[$this->form][$this->name])) ? $_POST[$this->form][$this->name]: $val;
    }
}
?>