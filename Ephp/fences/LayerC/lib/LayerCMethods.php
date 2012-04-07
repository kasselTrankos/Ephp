<?php
	namespace LayerC\lib;

	use LayerC\lib\BaseMethods;
	use LayerC\methods\Extend;
	use LayerC\methods\Includes;
	use LayerC\methods\Asset;
	use LayerC\methods\Routes;

	class LayerCMethods extends BaseMethods
	{
		public function __construct($code, $tags, $route){
			$this->add_layerc_method(array(
				'extends' => array(
					"class"  =>  $this, 
					'method' => '_Extends',
					'pattern'=> '/\{\%\s*extends\s*\'(.+)\'\s*\%\}/'
			)));
			$this->add_layerc_method(array(
				'include' => array(
					"class"  =>  $this, 
					'method' => '_Include',
					'pattern'=> '/\{\%\s*include\s*\'(.+)\'\s*\%\}/'
			)));
			$this->add_layerc_method(array(
				'asset' => array(
					"class"  =>  $this, 
					'method' => '_Asset',
					'pattern'=> '/\{\%\s*asset\s*\(\'(.+)\'\)\s*\%\}/'
			)));
			$this->add_layerc_method(array(
				'route' => array(
					"class"  =>  $this, 
					'method' => '_Route',
					'pattern'=> '/\{\%\s*route\s*\(\'(.+)\'\)\s*\%\}/'
			)));
			parent::__construct($code, $tags, $route);
		}		
			
		public function _Extends ($tag, $load, $tags, $currTag)
		{
			$extends = new Extend();
			return $extends->Execute($this->getHtml(), $load, $tags);
		}
		public function _Include($tag, $load, $tags, $currTag)
		{
			$include = new Includes($load, $this->getHtml(), $currTag);
			return $include->get();
		}
		public function _Asset($patten, $load, $tags, $currTag)
		{
			$asset = new Asset($load, $this->getHtml(), $currTag);
			return $asset->get();
		}
		public function _Route($patten, $load, $tags, $currTag)
		{
			$route = new Routes($load, $this->getHtml(), $currTag, $this->getRoute());
			return $route->get();
		}
	}
?>