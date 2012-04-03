<?php
namespace Ephp;
use Ephp\Route\Route;
use Ephp\serialize\Serialize;
use LayerC\LayerC;
use Ephp\session\Session;
use Ephp\Loader\Loader;
class Ephp
{
    private $route, $controller, $bin, $layerC;
    private $loader, $bycle = NULL;
    
    public function __construct($route, $bin=NULL)
    {
        $this->route = new Route($route, $bin);
        $this->loader = new Loader();
        $this->Run();
    }
    
    public function get($what){
        return $this->loader->get($what);
    }
    public function setBycle($value){
        $this->bycle = $value;
    }
    private function Run()
    {
    $controller = $this->route->controller();

    if ($controller){
        list($namespace, $class, $method)=preg_split('/:/', $controller);

        $session = new Session();
        $session->Add("fence", $namespace);
        $class.='Controller';
        $method.='Action';
        $c = $namespace.'\\Controller\\'.$class;
        $this->controller = new $c($this);
        $this->controller->server($this->route->server());
        $vars = $this->controller->{$method}();
        if($this->route->template()) $this->layerC = new layerC($this->route, $vars);
    }else{
        echo "nothing to load necesito un controllador";
    }

            ///print_r($vars);
    }
		
}
?>