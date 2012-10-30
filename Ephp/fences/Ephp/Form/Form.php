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
        $this->request = $_POST;                
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
    public function getHtmlLabel($name){return $this->fields[$name]->getLabel();}
    public function getFieldError($name){return $this->fields[$name]->getError();}
    public function getFieldByName($name){
        if(isset($this->fields[$name]))
            return $this->fields[$name];
    }
    private function getField($field, $name){
        switch ($field) {
            case 'text':
                return new InputText($name, $this->name);
                break;
            case 'checkbox':
                return new lib\Checkbox($name, $this->name);
                break;
            default:
                # code...
                break;
        }
    }
    public function error(){return $this->errors;}
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
                return $validate->valid($this);
                return FALSE;
            }
            return TRUE;    
        }
        return TRUE;
    }
    public function bind($req=NULL)
    {
        $this->request = $req;
    }    
}
?>
