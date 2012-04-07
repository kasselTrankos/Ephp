<?php
namespace Ephp;
require_once __DIR__.'/../../fences/sfYaml/lib/sfYaml.php';
require_once __DIR__.'/../../fences/sfYaml/lib/sfYamlParser.php';
require_once __DIR__.'/../../fences/sfYaml/lib/sfYamlInline.php';
require_once __DIR__.'/../../fences/Ephp/Event/NeighborsLoader.php';

require_once __DIR__.'/ClassLoader.php';

use Ephp\ClassLoader;
use Ephp\Event\NeighborsLoader;
use sfYaml\sfYaml;


class Configuration
{
    private $makefile='/../../app/makefile';
    private $libFolder='/../../fences';
    private $mainFolder='Ephp/';
    private $routing=array(), $bin=NULL;
    private $neighbors = array();

    private $loader;
    
    
    public function __construct(ClassLoader $loader=NULL)
    {
        $this->makefile = __DIR__.$this->makefile;
        $this->libFolder = __DIR__.$this->libFolder;
        $s = substr($_SERVER["DOCUMENT_ROOT"], 0, strlen($_SERVER["DOCUMENT_ROOT"])-3);
        $this->mainFolder = $s.$this->mainFolder;

        $this->loader = ($loader==NULL)? new ClassLoader():$loader;
    }
    public function getBin(){return $this->bin;}
    public function getNeighbors(){return $this->neighbors;}
    public function getRouting($clean=FALSE){
        if(!$clean)return $this->routing;
        foreach($this->bin[0] as $bin)
        {
            preg_match('/(.+)\[(.+)\]/', $bin, $m);
            $this->routing[$m[1]]=sfYaml::load($this->mainFolder.'/bin/'.$m[1].'/app/route.yml');
        }
        return $this->routing;
    }
    
    public function load()
    {
        try
        {
            $c=file_get_contents($this->makefile);
            if($s = preg_match_all('/[^\-]+/', $c, $f))
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


    public function libs($libs)
    {
        preg_match_all('/[^\s]+/', $libs, $lib);

        foreach ($lib[0] as $l) {
            preg_match('/(.+)\[(.+)\]/', $l, $item);
            $this->loader->registerNamespace($item[1], $this->mainFolder.'fences'.$item[2]);
            $neighbors = NeighborsLoader::load($this->mainFolder . 'fences/' . $item[1]);
            if($neighbors != FALSE)$this->neighbors[$item[1]] = $neighbors;
        }
    }
    private function route($routes)
    {
        preg_match_all('/[^\s]+/', $routes, $route);
        foreach ($route[0] as $r) 
            $this->routing['/Ephp']=sfYaml::load($this->mainFolder.$r);		
    }
    private function bin($bins){
        preg_match_all('/[^\s]+/', $bins, $bin);
        $this->bin = $bin;
        foreach($bin[0] as $b)
        {
            preg_match('/(.+)\[(.+)\]/', $b, $item);            
            $this->loader->registerNamespace($item[1], $this->mainFolder.'bin'.$item[2]);
        }
        $this->loader->register();
    }
}
?>