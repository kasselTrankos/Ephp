<?php
/**
*	Simple Template Engine, for PHP
*/
namespace LayerC;
use LayerC\lib\Translate;
use LayerC\lib\Loader;

class LayerC
{
	private $tpl, $routes;
	private $mainFolder = '/../../bin';

	
	public function __construct($route, $vars=NULL)
	{
		$loader= new Translate(Loader::load($route->template()), $route, $vars);
	}
}
?>