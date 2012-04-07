<?php
namespace Ephp\serialize;

use Ephp\Form\Form;

class Serialize
{
	public $serializes;
	public function __construct($args, $session)
	{
		foreach($args as $arg){
			if($arg instanceof Form) $this->makeForm($arg, $session);
		}
	}
	private function makeForm($arg, $session)
	{
		$session->Add("FORM", serialize($arg));
	}
}
?>