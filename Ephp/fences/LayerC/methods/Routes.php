<?php
namespace LayerC\methods;
use LayerC\methods\ILayerCMethod;
use LayerC\methods\BaseLayerCMethod;
class Routes extends BaseLayerCMethod  implements ILayerCMethod
{
	private $html;

	public function __construct($route, $code, $tag, $routes)
	{
		$this->html = $code;
		$ro = $routes->findByName($route);
		$this->lex($tag, $ro);
	}
	private function lex($tag, $replace)
	{
		$this->html = substr_replace($this->html, $replace, $tag["start"], $tag["length"]);
	}
	public function get() {return $this->html;}
}
?>