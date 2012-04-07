<?php
namespace WeMnid\Form;

use Ephp\Form\Form;

class LoginForm extends Form
{
    public function __construct($name)
    {
        parent::__construct($name);
        $this->append("text", 'name')->maxlength(10)->value("ats")->label("Usuario:");
        $this->append("text", 'pwd')->maxlength(10)->value("ats")->label("Contraseña:");
        $this->append('checkbox', 'accept')->label("Recordar");
    }


}
?>