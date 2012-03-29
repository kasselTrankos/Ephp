<?php
namespace LayerC\methods;

use Ephp\Form\Form;

class Forms
{
	private $args, $forms, $html='';
	private $func=array(
		'label' =>array('reg'=>'/^label/', 'func'=>'getLabel'),
		'field' =>array('reg'=>'/(.+)\.field\(\'\s*(.+)\s*\'\)/', 'func'=>'getField')
	);

	public function __construct($args, $pattern)
	{
		$this->setForm($args);
		$this->method($pattern);
		//print_r($this->forms);
	}
	public function html ()
	{
		return $this->html;
	}
	private function setForm($args)
	{
		foreach ($args as $arg) {
			if($arg instanceof Form) $this->forms[$arg->getName()] = $arg;
		}
	}
	public function method($text)
	{
		foreach ($this->func as $f)
		{
			if(preg_match($f["reg"], $text, $r))
			{
				return $this->{$f['func']}($this->forms[$r[1]], $r[2]);
			}
		}
	}
	private function getLabel(){

	}
	private function getPiece(){

	}
	private function getField($form, $name)
	{		
		$this->html = $form->getField($name);
	}
}
?>