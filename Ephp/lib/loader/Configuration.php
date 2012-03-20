<?php
namespace Ephp;

use Ephp\ClassLoader;
use sfYaml\sfYaml;
class Configuration
{
	private $makefile='/../../app/makefile';
	private $libFolder='/../../fences';
	private $mainFolder='/../../';
	private $routing=array(), $bin=NULL;

	private $loader;
	public function __construct(ClassLoader $loader=NULL)
	{
		$this->makefile = __DIR__.$this->makefile;
		$this->libFolder = __DIR__.$this->libFolder;
		$this->mainFolder = __DIR__.$this->mainFolder;

		$this->loader = $loader;
	}
	public function getRouting($clean=FALSE){
		if(!$clean)return $this->routing;
		foreach($this->bin[0] as $bin)
			$this->routing[$bin]=sfYaml::load($this->mainFolder.'/bin'.$bin.'/app/route.yml');
		
		return $this->routing;
	}
	public function getBin(){return $this->bin;}
	public function load()
	{
		try
		{
			$c=file_get_contents($this->makefile);
			if($s=preg_match_all('/[^\-]+/', $c, $f))
			{
				foreach($f[0] as $found){
					$found='-'.$found;
					if(preg_match('/(?<=\-libs\s).+$/', $found, $m))
						$this->libs($m[0]);
					if(preg_match('/(?<=\-routes\s).+$/', $found, $m))
						$this->route($m[0]);
					if(preg_match('/(?<=\-bin\s).+$/', $found, $m))
						$this->bin($m[0]);
					
				}

			}
		}catch(\Exception $e){
			print_r($e);
		}		
	}
	

	private function libs($libs)
	{
		preg_match_all('/[^\s]+/', $libs, $lib);
		foreach($lib[0] as $l)
			ClassLoader::load($this->libFolder.$l);		
	}
	private function route($routes){
		preg_match_all('/[^\s]+/', $routes, $route);
		foreach ($route[0] as $r) 
			$this->routing['/Ephp']=sfYaml::load($this->mainFolder.$r);		
	}
	private function bin($bins){
		preg_match_all('/[^\s]+/', $bins, $bin);
		$this->bin = $bin;
		foreach($bin[0] as $b)
			ClassLoader::load($this->mainFolder.'/bin'.$b);		
	
	}
}
?>