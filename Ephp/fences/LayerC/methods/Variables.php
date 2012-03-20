<?php
namespace LayerC\methods;

use LayerC\methods\Functions;
class Variables
{
	private $html, $functions;
	private $var='/\{\{(.+)\s?\}\}$|\\s?|/';

	public function __construct($code, $found, $args){
		$this->functions = new Functions();
		$this->html = $this->Replace($found, $code, $args);
		
	}
	public function get(){
		return $this->html;
	}
	private function Replace($found, $code, $args)
	{
		if(preg_match_all($this->var, $found['text'], $m))
		{
			if(preg_match('/\|/', $m[1][0]))
			{
				if(preg_match_all('/(\w+)\s?\|\s?(\w+)\s?/', $m[1][0], $mt))
				{
					$val = $args[$mt[1][0]];
					$func = $this->functions->Call($val, $mt[2][0]);
					$code = preg_replace('/'.preg_quote($found['text'], '/ ').'/', $func, $code);		
				}
				if(preg_match_all('/\'(.+)\'\s?\|\s?(\w+)\s?/', $m[1][0], $mt))
				{
					
					$val = $mt[1][0];
					$func = $this->functions->Call($val, $mt[2][0]);
					$code = preg_replace('/'.preg_quote($found['text'], '/ ').'/', $func, $code);		
				}
				
			}
			if(array_key_exists($m[1][0], $args)){
				$code = preg_replace('/'.preg_quote($found['text'], '/ ').'/', $args[$m[1][0]], $code);	
			}
			
		}
		return  $code;
	}

}
?>