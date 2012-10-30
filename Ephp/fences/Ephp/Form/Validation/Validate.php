<?php
namespace Ephp\Form\Validation;

/**
 * Description of ValidateForm
 *
 * @author Kassel
 */
use Ephp\Fences\Fences;
use Ephp\Form\Form;
use Annotation\Annotations;

class Validate
{
    private $form, $valid, $errors = array(), $ephp;
    
    public function __construct()
    {
        $fences = new Fences();
        $this->ephp = $fences->getFence("ephp");
    }
    public function isValid($request, $valid, Form $form)
    {        
        foreach($valid as $key=>$consts)
        {
            
            
            $field = $form->getFieldByName($key);
            
            foreach($consts as $nameConst=>$const)
            {
                $class  = 'Ephp\Form\Validation\Consts';
                $class.= '\\'.$nameConst;
                $constValidation =new  $class($const);
                $error = call_user_func_array(array($constValidation, 'Valid'), $constValidation->getArgs($request[$key]));
                ////$constValidation->Valid($request[$key], $constValidation->getArgs());
                
                if($error)
                {
                    $this->errors[]=array(
                        "message"=>$constValidation->message(),
                        "form"=>$form->getName(),
                        "field"=>$key
                    );  
                    $field->setError($constValidation->message());
                    break;
                }
            }
            
        }
        return (count($this->errors)==0) ? TRUE: $this->errors;
        
    }
}

?>
