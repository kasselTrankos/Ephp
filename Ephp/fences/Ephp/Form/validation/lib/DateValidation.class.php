<?php

/**
 * Description of DateValidation
 *
 * @author Kassel
 * @date 17-sep-2011 
 */
class DateValidation {
    private $format, $value, $reg;
    private $FORMATS=array(
        "dd/mm/Y"=>'/^[\d]{2}\/[\d]{2}\/[\d]{4}/'
    );
    
    public function __construct($format, $value){
       $this->format=$format; $this->value=$value;
       $this->setReg();
       
    }
    private function setReg(){
        $this->reg=$this->FORMATS[$this->format];
    }
    public function isValid(){
        $valid=preg_match_all($this->reg, $this->value, $m);
        return $valid;
    }
    
    
    
}

?>
