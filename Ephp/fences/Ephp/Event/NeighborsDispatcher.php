<?php
namespace Ephp\Event;
/**
 * Description of NeighborsDispatcher from ephp.home
 *
 * @author kassel
 */
use Ring\EventListener;
use Ring\Event;
class NeighborsDispatcher {
    public $neighbors = array();
    public $fences=array();


    private static $ins= NULL;
    
    public static function addFence($name, $value){
        NeighborsDispatcher::instance()->fences[$name] = $value;
    }
    public static function getFence($name){
        if(isset(NeighborsDispatcher::instance()->fences[$name]))
           return NeighborsDispatcher::instance()->fences[$name];
        return FALSE;
    }
    public static function Instance(){
        if(self::$ins==NULL){
            self::$ins = new NeighborsDispatcher();
        }
        return self::$ins;
    }
    public function add($args){
        self::instance()->neighbors = $args;
    }
    public function run($name, $args=NULL)
    {
        
        
        $evt = self::findByName($name);
        $run = TRUE;
        $params = array();
        $fences = NeighborsDispatcher::$ins->fences;
        foreach($evt['params'] as $key=>$val)
        {            
            if(isset($fences[$val])){
                $params[$key] = $fences[$val];
            }else if(isset($evt['fence'])){
                $initialize = new $evt['fence']();
                $arg = (isset($fences[$val]))? $fences[$val] : $args[$key];
                
                $params[$key] = $arg;
            }else{
                $run = FALSE;
                break;
            }
        }
        if($run){
            $event = new Event($name, $params);
            EventListener::Listener()->dispatch($event);
        }
        
    }
    private static function findByName($name){
        $args = self::instance()->neighbors;
        foreach($args as $arg)
            foreach($arg[key($arg)] as $evt)
                if($name == $evt['name'])
                    return $evt;
    }
}

?>
