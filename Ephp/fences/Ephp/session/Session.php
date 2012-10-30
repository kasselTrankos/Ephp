<?php
namespace Ephp\session;
/**
 * Debiera tener un modelo statico de acceso a cualquier variable
 * tanto para set como get 
 */
class Session
{
    public function __construct()
    {
        session_start();
    }
    public function Add($name, $arg){
        $_SESSION[$name] = $arg;
    }
    public static function get($name)
    {
        return $_SESSION[$name];
    }
    
}
?>