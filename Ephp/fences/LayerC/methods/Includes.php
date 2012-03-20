<?php
namespace LayerC\methods;
use LayerC\lib\Loader;

class Includes
{

	private $html='';
	public function __construct($code, $tag, $file)
	{
		$f=Loader::load($file);
		$this->html = $this->Replace($code, $tag, $f);
		
	}
	public function get(){ return $this->html;}
	private function Replace($code, $tag, $content){
		$code = preg_replace('/'.preg_quote($tag['text'], '/ ').'/', $content, $code);
		return $code;
	}
}
?>