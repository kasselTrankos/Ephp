<?php
namespace LayerC\lib;

use LayerC\lib\Lexer;
use LayerC\methods\Forms;

class BaseFunctions
{
	
	private $layerc_functions=array();
	private $html, $TAGS, $ARGS;

	public function __construct($code, $tags, $args)
	{
		$this->html = $code;
		$this->ARGS = $args;
		$this->TAGS = $tags["TAGS"];
		$this->Execute();
	}
	protected function add_layerc_function($func)
	{
		$this->layerc_functions[]=$func;
	}
	public function getHtml(){return $this->html;}
	private function UpdateLexer()
	{
		$lexer = new Lexer($this->html);
		$this->TAGS = $lexer->get('TAGS');
		if(count($this->TAGS)>0) $this->Execute();
		
	}
	protected function Execute()
	{
		foreach($this->layerc_functions as $m)
		{
			$obj=$m[key($m)];
			if($this->TAGS){
				foreach ($this->TAGS as $t) 
				{	
					if(preg_match($obj['pattern'], $t['text'], $match))
					{
						array_shift($match);
						$match[] = $this->ARGS;
						$re = call_user_func_array(array($obj["class"], $obj['method']), $match);
						$this->UpdateHtml($re, $t);
						$this->UpdateLexer();
						break;
					}
				}
			}
			
		}
	}
	private function UpdateHtml($re, $tag)
	{
		$this->html = substr_replace($this->html, $re, $tag['start'], $tag['length']);
	}
}
?>