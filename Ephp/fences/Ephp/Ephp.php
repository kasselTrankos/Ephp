<?php
	namespace Ephp;
	use Ephp\Route\Route;
	use LayerC\LayerC;
	class Ephp
	{
		private $route, $controller, $bin, $layerC;
		public function __construct($route, $bin=NULL)
		{
			
			$this->route = new Route($route, $bin);
			$this->Run();
		}
		private function Run()
		{
			$controller = $this->route->controller();

			if ($controller){
				list($namespace, $class, $method)=preg_split('/:/', $controller);

				$class.='Controller';
				$method.='Action';
				$c = $namespace.'\\Controller\\'.$class;
				$this->controller = new $c();
				$this->controller->server($this->route->server());
				$vars = $this->controller->{$method}();
				$this->layerC = new layerC($this->route, $vars);	
			}else{
				echo "nothing to load necesito un controllador";
			}
			
			///print_r($vars);
		}
		
	}
?>