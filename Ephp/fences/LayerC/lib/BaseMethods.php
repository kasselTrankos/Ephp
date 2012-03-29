<?php
namespace LayerC\lib;
use LayerC\lib\Lexer;

class BaseMethods
{
	private $code, $TAGS, $PIECES, $ROUTE;
	private $layerc_methdds=array();
	private $position=0;

	public function __construct($code, $nodes, $route)
	{
		$this->code = $code;
		$this->TAGS = $nodes;
		$this->ROUTE = $route;
		$this->Execute();

	}
	private function UpdateLexer()
	{
		$lexer = new Lexer($this->code);
		$this->TAGS = $lexer->get('PRIVATE');
		if(count($this->TAGS)>0) $this->Execute();
	}
	public function getHtml(){return $this->code;}
	public function setHtml($code){$this->code=$code;}
	protected function getRoute(){return $this->ROUTE;}
	//TODO: todavia hay otra vuelta de tuerca para conseguir volver a esta funcion a actualizar html

	protected function Execute()
	{

		//echo var_dump($this->TAGS);
		foreach($this->layerc_methdds as $m)
		{
			$obj=$m[key($m)];
			if(count($this->TAGS)==0) return FALSE;
			foreach ($this->TAGS as $t) 
			{
				if(preg_match($obj['pattern'], $t['text'], $match))
				{
					$match[] = $this->TAGS;
					$match[] = $t; 
					$this->code = call_user_func_array(array($obj["class"], $obj['method']), $match);
					$this->UpdateLexer();
					break;
				}
			}
		}
	}
	public function add_layerc_method($method){
		$this->layerc_methdds[]=$method;
	}
}
?>