<?php
namespace LayerC\lib;
use LayerC\lib\BaseFunctions;
use LayerC\methods\Forms;
use LayerC\methods\Variables;

class LayerCFunctions extends BaseFunctions
{
	public function __construct($code, $tags, $args)
	{
		$this->add_layerc_function(
		array('form'=>array(
			"class"  => $this,
			'method' => '_Form',
			'pattern'=> '/\{\{\s*form\.(.+)\s?\}\}/')));

		$this->add_layerc_function(
		array('var'=>array(
			"class"  => $this,
			'method' => '_Variables',
			'pattern'=> '/\{\{\s*(.+)\s*\}\}/')));

		parent::__construct($code, $tags, $args);
	}

	public function _Form($pattern, $args)
	{
		$form = new Forms($args, $pattern);
		return $form->html();
	}
	public function _Variables($pattern, $args){
		return  Variables::GetVariable($pattern, $args);
	}
}
?>