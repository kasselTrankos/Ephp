<?php
namespace Ring;
/**
 * Eventos Espia
 *
 * @author kassel
 */
use Ring\Event;
class EventListener {
    private $listeners = array();
    private static $_ins=NULL;
    public static function Listener(){
        if(self::$_ins==NULL) self::$_ins=new EventListener();
        return self::$_ins;
    }
    public function bind($name, $args=NULL)
    {        
        EventListener::Listener()->listeners[$name][] = array("class"=>$args[0], 'method'=>$args[1]);        
    }
    public function dispatch(Event $evt){
        $ears = EventListener::Listener()->getListener($evt->getName());
        if(!$ears) return FALSE;
        foreach($ears as $evts)
            call_user_func_array(array($evts['class'], $evts['method']), $evt->getParams());
        
    }
    public function getListener($name)
    {
        $evts = EventListener::Listener()->listeners;
        if(!isset($evts[$name])) return FALSE;
        foreach($evts as $key=>$val)        
            if($key == $name ) return $evts[$key];
    }
}

?>
