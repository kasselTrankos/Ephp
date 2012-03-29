<?php
	namespace LayerC\methods;

	use LayerC\methods\ILayerC;

	use LayerC\lib\Loader;
	use LayerC\lib\Lexer;
	use LayerC\methods\Variables;

	class Extend implements ILayerC
	{
		private $code, $html, $match, $methods, $piece, $pairs;

		private $pieces = array(
			'piece_start'=>'/\{\%\s*piece\s*\'(.+)\'\s*\%\}/',
			'piece_end'=>'/\{\%\s*endpiece\s*\%\}/'
		);

		public function __construct()
		{
			
			
		}		
		public function Execute($code, $load, $tags){
			$this->code = $code;
			$this->piece = $tags;
			$this->html = Loader::load($load);
			$c = new Lexer($this->html);
			$this->methods = $c->get();
			$this->Combine();
			return $this->get();
			
		}
		public function get(){return $this->html;}

		
		private function Combine()
		{
			$pairs = $this->MakePairs();
			foreach ($this->methods['PRIVATE'] as $f) {				
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
		private function GetReplace($start, $end)
		{			
			$_start = $start['item']['start']+$start['item']['length'];
			$_end = $end['start']-$_start;
			return substr($this->code, $_start, $_end);			
		}

	}
?>