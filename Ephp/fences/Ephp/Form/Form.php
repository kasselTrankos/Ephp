<?php
namespace Ephp\Form;

/**
 * Description of Form
 *
 * @author Kassel
 */
use Ephp\Form\core\ValidateForm;
use Ephp\Form\lib\InputText;
use sfYaml\sfYaml;
use Ephp\session\Session;
use Ephp\Form\Validation\Validation;

class Form 
{
    
    private $name="form", $fields=array(), $request= NULL, $errors;
    
    public function __construct($name="")
    {        
        $this->name=$name;       
    }
    public function append($field, $name=NULL)
    {
        if($name==NULL) throw new \Exception("necesita un puto nombre");
        $f= $this->getField($field, $name);
        $this->fields[$name] = $f;
        return $f;
    }
    public function getName(){return $this->name;}
    public function getHtmlField($name){return $this->fields[$name]->getField();}

    private function getField($field, $name){
        switch ($field) {
            case 'text':
                return new InputText($name, $this->name);
                break;
            
            default:
                # code...
                break;
        }
    }

    public function isSubmitted(){
        return ((isset($_POST) && !empty ($_POST)) || (isset($_FILES) && !empty($_FILES)));
    }
    public function isValid()
    {
        $file = __DIR__.'/../../../bin/'.Session::get("fence").'/app/validation.yml';
        
        if(file_exists($file)) 
        {
            $yml = sfYaml::load($file);
            $class = (string)get_called_class();
            
            if(isset($yml[$class]))
            {
                $validate = new Validation($this->request[$this->name], $yml[$class]);
                $this->errors = $validate->valid($this);
                return $this->errors;
            }
            return TRUE;    
        }
        return TRUE;
    }
    public function bind($req=NULL)
    {
        $this->request = $req;
    }
    



    /*
    public function getSubmitted(){
        $r=array();
       
        foreach($this->fields as $field){       
            $class=$field["class"];
            $r[$class->Name()]=$class->getSubmitted();
        }
        return $r;
    }/*
    public function getField($value){
        $class=$this->fields[$value]["class"];
        return $class->getHtml();
    }
    public function get($name){
        $class=$this->fields[$name]["class"];
        return $class->getSubmitted();
    }
    public function set($name, $value){
        $class=$this->fields[$name]["class"];
        $class->set($value);
    }
    public function Validate($name, $value=FALSE){
        $class=$this->fields[$name]["class"];
        $class->setValidate($value);
    }
    
    public function CreateView()
    {   
        $fields=array_keys($this->fields);
        foreach($fields as $field){           
            $class=$this->fields[$field]["class"];
            $this->fields[$field]["html"]=$class->getHtml();
        }
        //print_r(Data::$FORMS);
        return $this->fields;
    }
    public function add($name, $field="", $args=NULL)
    {       
        
        $this->fields[$name]=$args;       
        $this->createField($name, $field, $args);
        ///echo $this->name."-";
        Data::$FORMS[$this->name][$name]=$this->fields[$name];
    }
    public function setName($value){$this->name = $value;}
    /**
     *  Añadir field
     * @param type $name
     * @param field $field
     * @param type $args 
     */
    /*
    private function createField($name, $field, $args){        
        require_once $this->path.$field.'.class.php';        
        $field=new $field($this->name, $name, $args, $this->getVal($name, $field));        
        $this->fields[$name]["class"]=$field;
    }
    public function isSubmitted(){        
        return ((isset($_POST) && !empty ($_POST)) || (isset($_FILES) && !empty($_FILES)));
    }
    public function isValid(){
        $valid=new ValidateForm($this);
        return $valid->isValid();        
    }
    public function getErrors(){
        return Data::$ERROR;
    }
    
    private function getVal($name, $field){
        if($field=="File") return FALSE;
        if(!$this->isSubmitted()) return FALSE;
        $key=key($_POST);        
        return (empty($_POST[$key][$name]))? "":$_POST[$key][$name];
    }
    private function setFilesData(){
        Data::$FORM_DATA[$this->key]["file"]=$_FILES[$this->key];
    }
    */
    
}

?>
