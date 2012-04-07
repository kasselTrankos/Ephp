<?php
namespace Ephp\Route;
use Ephp\Url\Url;
use Ephp\Route\CleanRoute;


class Route
{
    private $routing, $url, $tpl=NULL, $route, $controller;

    public function __construct($routing, $bin)
    {
        $this->routing = CleanRoute::clean($routing);			
        $this->url = new Url();
        $this->find();

    }
    public function server(){return $this->url;}
    public function controller(){return $this->controller;}
        public function template(){return $this->tpl;}

        public function findByName($name)
        {
            foreach ($this->routing as $item)
                if($item[$name]) return $item[$name]['pattern'];
            return NULL;			
        }
        private function find($name=NULL)
        {
                ///$uri=($name!=NULL);
                foreach ($this->routing as $item) 
                {
                        foreach($item as $key=>$route)
                        {
                                $pattern = '/'.addcslashes($route['pattern'], '/').'$/';					
                                if(preg_match($pattern, $this->url->getURI())) {	
                                        $this->controller = $route['defaults']['controller'];
                                        $this->tpl = (isset($route['defaults']['template'])) ? $route['defaults']['template']: NULL;
                                        $this->route[$key] = $route;
                                }
                        }
                }
        }
}
?>