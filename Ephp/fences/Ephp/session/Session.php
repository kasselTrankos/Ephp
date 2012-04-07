<?php
namespace Ephp\session;
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