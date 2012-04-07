<?php
namespace Ephp\Fences;
/**
 * Description of Fences from ephp.home
 *
 * @author kassel
 */
use Ephp\Event\NeighborsDispatcher;
class Fences
{
    private $fences = array();
    public function __construct(){
        
    }
    public function Add($name, $fence){
        if(!isset($this->fences[$name])){
            $this->fences[$name] = $fence;
            NeighborsDispatcher::instance()->addFence($name, $fence);
        }else{
            //TODO: disparar aqui una exception
        }
        
    }
}

?>
