<?php

/**
 * Description of FileValidation
 *
 * @author Kassel
 * @date 26-sep-2011 
 */
class FileValidation extends BaseValidation{ 
    private $FORMATS=array(
        "pdf"=>"application/pdf"
    );
    private $file, $loaded=FALSE;
    public function isValid(&$errors)
    {
        
        foreach($this->val as $k=>$v){
            if($k=="format") $this->isValidFormat ($this->val["format"], $errors);
            if($k=="size") $this->isValidSize ($this->val["size"], $errors);
        }
        ///print_r(Data::$ERROR);
    }
    
    public function isValidFormat($val, &$err)
    {
        $form=$this->getForm();
        $format=$form["type"];
        $valid=$this->FORMATS[$val["value"]];
        if($valid!=$format){
            $err++;
            Data::$ERROR[][$this->getFormName()]=$val["message"];
        }
        
    }
    
    public function isValidSize($val, &$err)
    {
        $vv=strtolower($val["value"]);
        $v=preg_match('/([\d]+)([\w]+)/', $vv, $m);
        $iSize=$m[1];
        $sSize=$m[2];
        $maxSize=0;
        $form=$this->getForm();
        
        $rSize=(int)$form["size"];
        if($sSize=="mb") $maxSize=(int)$iSize*1024*1024;
        if($maxSize<$rSize){            
            Data::$ERROR[][$this->getFormName()]=$val["message"];
            $err++;
        }
        
    }
    /////////////////
    private function setFile(){
        if(!$this->loaded){
            $this->file=$_FILES;
            $this->file=$this->file[$this->getFormName()];
        }
    }
    
    
    
}

?>
