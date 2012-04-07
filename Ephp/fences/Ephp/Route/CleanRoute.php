<?php
namespace Ephp\Route;

class CleanRoute{
	public function __construct(){

	}
	public static function clean($route){
		$r=array();
		$route = CleanRoute::putInOrder($route);
		foreach ($route as $k=>$v) 
		{
			$r[$k]=array();
			foreach($v as $key=>$val){
				if(!CleanRoute::isRepeat($r, $val["pattern"])) $r[$k][$key]=$val; 
			}
		}
		return $r;
	}
	private function putInOrder($route)
	{
		$ephp=array();
		$r=array();
		if(array_key_exists('/Ephp', $route))
		{
			$ephp['/Ephp']=$route['/Ephp'];
			unset($route['/Ephp']);
			foreach($route as $k=>$v) $r[$k] = $v;
			$r['/Ephp']=$ephp['/Ephp'];
			return $r;
		}
		return $route;
	}
	private function isRepeat($r, $pattern)
	{
		$reg = '/'.addcslashes($pattern, '/').'$/';
		foreach($r as $item)
			foreach ($item as $key => $val)				
				if(preg_match($reg, $val['pattern'])) return TRUE;
		
		return FALSE;
	}
}
?>