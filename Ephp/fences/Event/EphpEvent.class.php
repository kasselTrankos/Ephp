<?php
namespace Event;

/**
 * Description of EphpEvent
 *
 * @author watson
 */
///require_once dirname(__FILE__).'/core/Event.php';
use Event\core\Event;

class EphpEvent 
{
    
    private  $events=array();   
    private static $_ins=NULL;
    /**
     *
     * @return <type> 
     */
    private static function Init(){
        if(self::$_ins==NULL) self::$_ins=new EphpEvent ();
        return self::$_ins;
    }
    

    /**
     * Basic add silent notifier
     */
    public function addEventDispatcher($name, $method){
        EphpEvent::Init()->AddEvent($name, $method);
    }
    public function dispatchEvent(Event $evt=NULL){
        foreach (EphpEvent::Init()->getListeners($evt->getName()) as $listener){
            call_user_func($listener, $evt);
        }
    }
    
    /////////////////->PRIVATE
    private function AddEvent($name, $method){
         if(!array_key_exists($name, EphpEvent::Init()->events)){
             EphpEvent::Init()->events[$name][]=$method;
         }         
    }
    private function getListeners($name){
        if(!array_key_exists($name, EphpEvent::Init()->events)){
            return array();
        }
        return EphpEvent::Init()->events[$name];
    }
}
?>
