<?php
namespace LayerC\lib;

class Loader{
	private static $mainFolder='/../../../bin';
	public static function load($tpl)
	{
		preg_match_all('/[^\:]+/', $tpl, $m);
		$file = __DIR__.Loader::$mainFolder;
		for($i=0; $i<count($m[0]); $i++){
			$file .= '/'.$m[0][$i];
			if($i==0) $file.='/view';
		}
		$file .= '.html';
		$file = file_get_contents($file);
		return $file;
	}
}
?>