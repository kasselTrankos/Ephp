<?php
namespace LayerC\methods;
use LayerC\lib\Loader;
use LayerC\methods\ILayerC;

class Includes implements ILayerC
{

	private $html='';
	public function __construct($load, $code, $tag)
	{
		$file=Loader::load($load);
		$this->html = $this->Replace($code, $tag, $file);
		
	}
	public function get(){ return $this->html;}
	private function Replace($code, $tag, $file){
		$code = substr_replace($code, $file, $tag["start"], $tag["length"]);
		return $code;
	}
}
?>