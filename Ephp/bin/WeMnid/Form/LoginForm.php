<?php
namespace WeMnid\Form;

use Ephp\Form\Form;
class LoginForm extends Form
{
	public function __construct($name)
	{
		parent::__construct($name);
		$this->append("text", 'name')->maxlength(10)->value("test");
		$this->append("text", 'pwd')->maxlength(10)->value("test");

	}


}
?>