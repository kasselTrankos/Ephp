<?php

/**
 * Description of Coice
 *
 * @author Kassel
 */
class Choice  extends BaseField{
    
    private $html="<select name=\"{name}\"></select>";
    
    public function __construct($form, $name, $args, $submitted){
        parent::__construct($form, $this->html, $name, $args, $submitted);
        $this->Expanded();
    }
    public function set($value) {
        $args=$this->getArgs();
        $args["selected"]=$value;
        $this->setArgs($args);
        
        
        
        //parent::set($value);
        $this->Expanded();
    }
    private function Expanded(){
        
        $args=$this->getArgs();
        
        if($args!=NULL){            
            if(array_key_exists("expanded", $args)){
                if($args["expanded"]){
                    $html="<div id=\"".$this->getName()."\" >";
                    
                    $selected=(isset($args["selected"])) ? $args["selected"] : FALSE;
                    
                    foreach($args["choices"] as $k=>$v){
                        $id=$this->getForm()."_".$this->getName()."_".$k;
                        if($selected!=$k) $html.="<input type=\"radio\" value=\"".$k."\" name=\"".$this->getFieldName()."\" id=\"".$id."\" >";
                        else $html.="<input type=\"radio\" value=\"".$k."\" name=\"".$this->getFieldName()."\" id=\"".$id."\" CHECKED  >";
                        $html.="<label for=\"".$id."\">".$v."</label>";
                    }
                    $html.="</div>";
                }                
            }
        }
        $this->setField($html);
        
    }
    
}

?>
