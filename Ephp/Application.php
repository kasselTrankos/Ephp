<?php

namespace Ephp;

require_once __DIR__.'/lib/loader/Configuration.php';



/**
 * Description of Application
 *
 * @author kassel
 */
use Ephp\ClassLoader;
use Ephp\Configuration;
use Ephp\Ephp;

class Application 
{
    public function __construct()
    {
    	
    	$config = new Configuration();
    	$config->load();
    	$ephp = new Ephp($config->getRouting(TRUE), $config->getBin());
     
    }
}
?>
