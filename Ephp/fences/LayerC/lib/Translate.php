<?php
namespace LayerC\lib;

use LayerC\lib\Lexer;

class Translate
{
	private $routes;
	private $code, $html, $tags, $args;
	private $lexer, $cond;
	
	public function __construct($code, $route, $args=NULL)
	{
		$this->html = $code;
		
		$methods = new LayerCMethods($code, $this->Lexer($code, 'PRIVATE'), $route, $args);
		$code = $methods->getHtml();
		$functions = new LayerCFunctions($code, $this->Lexer($code, 'TAGS'), $args);
		$code =$functions->getHtml();
		$this->html = $code;
		echo $this->html;
	}
	public function Lexer($code, $what){
		$c=new Lexer($code);	
		return $this->tags=$c->get($what);
	}
	
}
?>