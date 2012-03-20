<?php
namespace LayerC\lib;
use LayerC\methods\Extend;
use LayerC\lib\Lexer;
use LayerC\methods\Variables;
use LayerC\methods\Includes;
use LayerC\methods\Conditional;

class Translate
{
	private $routes;
	private $code, $html, $tags, $args;
	private $lexer, $cond;
	private $methods=array(
		'extends' => array('reg'=>'/\{\{\s*extends\s*\'(.+)\'\s*\}\}/', 'func'=>'_Extends')
	);
	private $pieces=array(
		'include'=>array('reg'=>'/\{\%\s*include\s*\'(.+)\'\s*\%\}/', 'func'=>'_Include'),
		'asset' =>array('reg'=>'/\{\%\s*asset\s*\(\'(.+)\'\)\s*\%\}/', 'func'=>'_Asset'),
		'route' =>array('reg'=>'/\{\%\s*route\s*\(\'(.+)\'\)\s*\%\}/', 'func'=>'_Route'),
	);
	public function __construct($code, $routes, $vars=NULL)
	{
		$this->code = $code;
		$this->html = $code;
		$this->args = $vars;
		$this->routes = $routes;
		$this->Lexer($code, $vars);

		
		if(array_key_exists('PIECES', $this->tags)){
			$this->cond = new Conditional();
			$this->_Conditionals($vars);
			foreach ($this->tags['PIECES'] as $piece) {					
				if(preg_match($this->pieces['include']['reg'], $piece['text'], $m))
					$this->{$this->pieces['include']['func']}($piece, $m, $vars);
			}
			foreach ($this->tags['PIECES'] as $piece) {
				if(preg_match($this->pieces['asset']['reg'], $piece['text'], $m))
					$this->{$this->pieces['asset']['func']}($piece, $m, $vars);
			}
			foreach ($this->tags['PIECES'] as $piece) 					{
				if(preg_match($this->pieces['route']['reg'], $piece['text'], $m))
					$this->{$this->pieces['route']['func']}($piece, $m, $vars);
			}
		}
		

		

		foreach($this->tags['TAGS'] as $tag)
		{
			foreach($this->methods as $m)
			{
				if(preg_match($m["reg"], $tag['text'], $match))
				{
					$this->{$m['func']}($tag, $match, $vars);
				}else{
					$v= new Variables($this->html, $tag, $vars);
					$this->html = $v->get();
				}
			}

		}
		echo $this->html;
	}
	/**
	*	Metodo recursivo para ir de 1 en 1 
	*	Cargando las condigionales, ya que cambia la longitud del texto
	*/
	private function _Conditionals($vars)
	{
		$conds = $this->cond->make($this->tags['PIECES']);
		if($conds == NULL) return FALSE;
		$this->html = $this->cond->Execute($conds[0], $this->html, $vars);
		if(count($conds)>1)
		{
			$this->Lexer($this->html, $vars);			
			$this->_Conditionals($vars);
		}		
	}
	public function Lexer($code, $args){
		$c=new Lexer($code, $args);	
		$this->tags=$c->get();
	}
	///EXTENDER
	private function _Extends($tag, $match, $vars)
	{
		$pieces = (array_key_exists('PIECES', $this->tags)) ? $this->tags['PIECES']: NULL;
		$extend= new Extend($this->html, $tag, $match, $vars, $pieces);
		$this->html = $extend->parent();
	}
	private function _Include($tag, $match, $vars){
		$i = new Includes($this->html, $tag, $match[1]);
		$this->html= $i->get();
		$this->Lexer($this->html, $vars);
	}
	private function _Asset($tag, $match, $args){
		$c=preg_replace('/\:/', '/', $match[1]);
		$this->html=preg_replace('/'.preg_quote($tag['text'], '/ ').'/', '/'.$c, $this->html);
		$this->Lexer($this->html, $args);
	}
	private function _Route($tag, $match, $args)
	{
		//preg_match('/{\%\s*route\s*\(\'(.+)\'\)\s*\%\}/', $tag['text'], $m);
		$path = $this->routes->findByName($match[1]);
		$this->html = substr_replace($this->html, $path, $tag['start'], $tag['length']);
		$this->Lexer($this->html, $args);
	}
	
}
?>