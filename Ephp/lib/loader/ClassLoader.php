<?php
	namespace Ephp;
	///require_once '/home/ephp.home/Ephp/lib/loader/../../fences/Ephp/Ephp.php';
	class ClassLoader
	{
		private $_fileExtension = '.php';
		protected $namespaces = array();
		protected $prefixes = array();
		private $_namespace;
    private $_includePath;
    private $_namespaceSeparator = '\\';

		public function getNamespaces()
		{
			return $this->namespaces;
		}
		//Carga de las clases
		public function registerNamespaces($namespaces)
		{
			foreach($namespaces as $ns=>$path)
				$this->registerNamespace($ns, $path);
		}
		public function registerNamespace($namespace, $path)
		{
			if(isset($this->namespaces[$namespace])){
				$path = array_merge($this->namespaces[$namespace], $path);
			}
			$this->namespaces[$namespace] = $path;
		}

		public function register()
		{

			
			
			spl_autoload_register(array($this, 'loadClass'), true, false);	
			//$fun = spl_autoload_functions();
			//print_r($fun);
		}	
		public function loadClass($className){

			if (null === $this->_namespace || $this->_namespace.$this->_namespaceSeparator === substr($className, 0, strlen($this->_namespace.$this->_namespaceSeparator))) {
            $fileName = '';
            $namespace = '';
            $path = '';
            if (false !== ($lastNsPos = strpos($className, $this->_namespaceSeparator))) 
            {
                $namespace = substr($className, 0, $lastNsPos);
                $path =$this->namespaces[$namespace];
                $className = substr($className, $lastNsPos + 1);
                $fileName = str_replace($this->_namespaceSeparator, DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR;

            }
            $fileName .= str_replace('_', DIRECTORY_SEPARATOR, $className) . $this->_fileExtension;
            $fileName = str_replace('\\', DIRECTORY_SEPARATOR, $fileName);
            require ($this->_includePath !== null ? $this->_includePath . DIRECTORY_SEPARATOR : '').$path.'/' . $fileName;
        }
		}
	}
?>