<?php
namespace Ephp\Event;
/**
 * Description of LoadEvents from ephp.home
 *
 * @author kassel
 */
use sfYaml\sfYaml;

class NeighborsLoader 
{
    public function __construct(){
        
    }
    public static function load($path)
    {
        $n = $path.'/app/neighbor.yml';
        if(file_exists($n))
            return sfYaml::load($n);
        
        return FALSE;
    }
}

?>
