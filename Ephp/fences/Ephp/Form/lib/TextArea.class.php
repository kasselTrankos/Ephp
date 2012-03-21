<?php

/**
 * Description of TextArea
 *
 * @author Kassel
 */
class TextArea  extends BaseField{
    private $html="<textarea name=\"{name}\" id=\"{id}\">{value}</textarea>";
    
    public function __construct($form, $name, $args, $submitted){
        parent::__construct($form, $this->html, $name, $args, $submitted);
    }
    public function updateVal($value){
        
        $f=$this->getField();
        if(strlen($value)==0) $value="void";
        
        $f=preg_replace('/(?<=\>)(.*?)(?=\<)/',$value,  $f);
        $this->setField($f);
    }
}

?>
