<?php

namespace Ephp;
use Ephp\Route\Route;
use Ephp\serialize\Serialize;
use LayerC\LayerC;
use Ephp\session\Session;
use Ephp\Loader\Loader;
use Annotation\Annotations;
use Ring\Event;
use Ring\EventListener;
use Ephp\Fences\Fences;
use Ephp\Event\NeighborsDispatcher;


class Ephp
{
    private $route, $controller, $layerC;
    private $loader, $fences, $neighbors;
    private $args=NULL;
    
    public function __construct($route, $bin, $neighbors=NULL)
    {
       
        
        ////EventListener::Listener()->bind($evtController);
        $this->fences = new Fences();
        $this->fences->Add("ephp", $this);
        NeighborsDispatcher::Instance()->add($neighbors);
        $this->route = new Route($route, $bin);
        $this->fences->Add("Route", $this->route);
        $this->loader = new Loader();
        $this->fences->Add("loader", $this->loader);
        $this->Run();
    }
    
    public function get($what){return $this->loader->get($what);}
    public function route($name){return $this->route->findByName($name);}
    private function Run()
    {
        
        $controller = $this->route->controller();
        
        Annotations::$config['cachePath'] = __DIR__ . '/../../app/cache';
        if ($controller)
        {
            list($namespace, $class, $method)=preg_split('/:/', $controller);        
            $session = new Session();
            $this->fences->Add("session", $session);
            $session->Add("fence", $namespace);
            $class.='Controller';
            $method.='Action';
            $c = $namespace.'\\Controller\\'.$class;
            $this->controller = new $c($this);
            
            $this->fences->Add("controller", $this->controller);
            $this->controller->server($this->route->server());
            $mAnnotation= Annotations::ofMethod($this->controller, $method);
            $vars = $this->controller->{$method}();
            //$evtController = new Event("on.loadController", array("controller"=>$this->controller));
            NeighborsDispatcher::Instance()->run('on.loadController');
            //EventListener::Listener()->dispatch($evtController, $evtController);
            if($this->route->template()) $this->layerC = new layerC($this->route, $vars);
        }else{
            echo "nothing to load necesito un controllador";
        }
            ///print_r($vars);
    }
		
}
?>