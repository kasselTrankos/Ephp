<?php
namespace Ephp\Form\lib;
class MyField{
    protected $html= '', $name = '', $form = '', $label = ''; 
    public function __construct($name, $form){
        $this->name = $name;
        $this->form = $form;
    }
    public function getField(){return $this->html;}
    public function getLabel(){
        return '<label for="'.$this->form.'_'.$this->name.'">'.$this->label.'</label>';
    }
    public function label($name){$this->label = $name;} 
}
?>