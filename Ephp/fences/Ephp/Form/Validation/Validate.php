<?php
namespace Ephp\Form\Validation;

/**
 * Description of ValidateForm
 *
 * @author Kassel
 */
class Validate
{
    private $form, $valid, $errors = array();
    public function __construct()
    {
    }
    public function isValid($request, $valid, $name)
    {        
        foreach($valid as $key=>$val)
        {
            $class  = 'Ephp\Form\Validation\Consts';            
            $class.='\\'.key($val);
            $valids =new  $class($val[key($val)]);
            $m = $valids->Valid($request[$key], $val[key($val)]);
            if(is_string($m)) {
                $this->errors[]=array(
                    "message"=>$m,
                    "form"=>$name,
                    "field"=>$key
                );                
            }
        }
        return (count($this->errors)>0) ? $this->errors: TRUE;
        
    }
}

?>
