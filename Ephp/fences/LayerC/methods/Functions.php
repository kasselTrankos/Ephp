<?php
namespace LayerC\methods;
/**
* 
*/
class Functions
{
	
	private $func=array(
		'capitalize'=>'Capitalize'
	);

	public function __construct()
	{

	}
	public function Call($arg, $func){
		$f = $this->func[$func];
		return $this->{$f}($arg);
	}
	private function Capitalize($arg){
		$s = preg_split('/\s/', $arg);
		$DONE = FALSE;
		$str = '';
		for($i=0; $i<count($s); $i++){
			$p = $s[$i];			
			if(!$DONE){
				if(preg_match('/\w/', $p)){
					$p = ucwords($p);
					$DONE=TRUE;
				}
			}
			$str.=$p.' ';
		}

		return substr($str, 0, strlen($str)-1);
	}
}
?>