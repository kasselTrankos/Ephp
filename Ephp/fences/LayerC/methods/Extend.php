<?php
	namespace LayerC\methods;

	use LayerC\lib\Loader;
	use LayerC\lib\Lexer;
	use LayerC\methods\Variables;

	class Extend
	{
		private $code, $html, $match, $methods, $piece, $pairs;

		private $pieces = array(
			'piece_start'=>'/\{\%\s*piece\s*\'(.+)\'\s*\%\}/',
			'piece_end'=>'/\{\%\s*endpiece\s*\%\}/'
		);

		public function __construct(&$code, $tag, $match, $vars, $piece)
		{
			$this->code = $code;
			$this->piece = $piece;


			$this->html = Loader::load($match[1]);
			$c = new Lexer($this->html, $vars);
			$this->methods = $c->get();
			$this->Combine();
			$this->Variables($vars);
			
		}		
		public function parent(){return $this->html;}

		private function Variables($args)
		{
			//TODO: mostrar una exception propia?
			if($args==NULL) return FALSE;

			foreach ($this->methods['TAGS'] as $var) 
			{				
				$v = new Variables($this->html, $var, $args);
				$this->html = $v->get();
			}

		}
		private function Combine()
		{
			$pairs = $this->MakePairs();
			foreach ($this->methods['PIECES'] as $f) {				
				foreach ($pairs as $p) 
				{					
					if(preg_match('/'.preg_quote($p['start']['item']['text'], '/ ').'/', $f['text']))
					{			
						
						$re = $this->GetReplace($p['start'], $p['end']);
						$this->html = preg_replace('/'.preg_quote($f['text'], '/ ').'/', $re, $this->html);
						
					}
				}
			}
		}
		private function MakePairs()
		{
			$f=array();//founded pieces
			if($this->piece == NULL) return $f;
			$c=0;//counter for found
			
			foreach($this->piece as $item)
			{
				
				if(preg_match_all($this->pieces['piece_start'], $item['text'], $m)){
					$f[$c]['start']['item']=$item;
					$f[$c]['start']['found']=$m[1][0];					
					
				}
				if(preg_match($this->pieces['piece_end'], $item['text'])){
					$f[$c]['end']=$item;
					$c++;
				}
			}
			return $f;
		}
		private function GetReplace($start, $end){
			
			$s = $start['item']['start']+$start['item']['length'];
			$e = $end['start'];
			$replace='';
			for($i=$s; $i<$e; $i++)
				$replace.=$this->code[$i];
			return $replace;

		}

	}
?>