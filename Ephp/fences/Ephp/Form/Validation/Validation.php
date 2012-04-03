<?php
namespace Ephp\Form\Validation;
/**
 * Description of Validation
 *
 * @author Kassel
 * @date 07-oct-2011 
 */
use Ephp\Form\Validation\Validate;
class Validation 
{
    private $request, $validation;
    private $validate;
    
    public function __construct($request, $validation)
    {
        $this->request = $request;
        $this->validation = $validation;
        $this->validate = new Validate();
    }
    public function valid($form)
    {
        return $this->validate->isValid($this->request, $this->validation, $form->getName());
    }
}

?>
