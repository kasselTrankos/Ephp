 <?php

//require_once dirname(__FILE__).'/core/BaseValidation.class.php';
require_once dirname(__FILE__).'/Validation.class.php';
require_once dirname(__FILE__).'/BaseValidation.class.php';
/**
 * Description of ValidateForm
 *
 * @author Kassel
 */

class ValidateForm {
    
    private $formname, $form, $valid, $data, $error=0, $file, $loadFile=FALSE;
    private $FORMS;
    
    public function __construct($form)
    {
        if(!empty ($_FILES)) $this->formname=key($_FILES);
        if(!empty ($_POST))$this->formname=key($_POST);        
        $this->FORMS=Data::$FORMS[$this->formname];
        
        if(!empty ($_FILES)) {
            $this->data=$_FILES[$this->formname];
            $this->data=$this->FromFiles();
        }
        if(!empty ($_POST)) $this->data=$_POST[$this->formname];        
        $this->form=$form;
        
        $validate=(isset(Data::$VALIDATION[$this->formname]));
        
        if($validate){
            $this->valid=Data::$VALIDATION[$this->formname];
            $this->Validate();
        }
        
    }
    
    public function get($key){
        $keys=key($_POST);
        $data=$_POST[$keys];        
        return $data[$key]; 
    }
    private function setFormData(){
        
    }
    
    
    private function Validate()
    {        
        foreach($this->valid as $key=>$val)
        {
            $class=$this->FORMS[$key]["class"];
            if($class->doValidation()){
                foreach($val as $k=>$v){                
                    /*if($k!="imagetype")$this->{$k}($key, $v);  
                    else $this->UploadFile($key, $v);*/
                    ///print_r($this->data[$key]);
                    $validation=Validation::factory($k);                    
                    $validation->setForm($this->data[$key]);
                    $validation->setValue($v);
                    $validation->setFormname($this->formname."_".$key);
                    $validation->isValid($this->error);
                }   
            }
        }
        
    }
    private function FromFiles(){
        
        $tmp=array();
        foreach($this->data as $key=>$val){
            $nameField=key($val);
            $tmp[$key]=$item[$key]=$val["pdf"];
        }
        return array($nameField=>$tmp);
    }
    public function isValid(){
        return ($this->error==0 && count(Data::$ERROR)==0);
    }
    private function UploadFile($key, $val){
        require_once dirname(__FILE__).'/../image/FileUpload.class.php';
        $upload=new FileUpload($key);        
        if(!$upload->validType($val["value"])){
            Data::$ERROR[][$this->formname."_".$key]=array("message"=>$val['message']);        
            $this->error++;
        }
        
    }
    private function minlength($key, $val)
    {
        $form=$this->data[$key];        
        if(strlen($form)<$val["value"]) {
            Data::$ERROR[][$this->formname."_".$key]=array("message"=>$val['message']);        
            $this->error++;
        }
    }
    private function date($key, $val){
        require_once dirname(__FILE__).'/lib/DateValidation.class.php';        
        $value=$this->data[$key];        
        $validation=new DateValidation($val["format"], $value);
        if(!$validation->isValid()){
            Data::$ERROR[][$this->formname."_".$key]=array("message"=>$val['message']);        
            $this->error++;
        }
    }
    private function format($key, $val){
        if(!$this->loadFile){
            require_once dirname(__FILE__).'/lib/FileValidation.class.php';
            $this->file=new FileValidation($key, $val, $this->formname);
            $this->loadFile=true;
        }        
        $this->file->isValidFormat();
        if(!$this->file->isValid()){
            Data::$ERROR[][$this->formname."_".$key]=array("message"=>$val['message']);        
            $this->error++;
        }
    }
    private function size($key, $val){
        
        if(!$this->loadFile){
            require_once dirname(__FILE__).'/lib/FileValidation.class.php';
            $this->file=new FileValidation($key, $val, $this->formname);
            $this->loadFile=true;
        }     
        $this->file->isValidSize($key, $val);
        if(!$this->file->isValid()){
            Data::$ERROR[][$this->formname."_".$key]=array("message"=>$val['message']);        
            $this->error++;
        }
    }
    private function method($key, $val){
        require_once Server::getBasePath().$val["path"];
        list($name, $method)=explode("->", $val["method"]);
        $load=new $name();
        
        if(!$load->{$method}()){
            Data::$ERROR[][$this->formname."_".$key]=array("message"=>$val['message']);        
            $this->error++;
        }
    }
    
}

?>
