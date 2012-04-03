<?php
namespace Bycle\core;
/**
 * Description of BycleConnection from ephp.home
 *
 * @author kassel
 */
class BycleConnection 
{
    private $args, $link;
    public function __construct($args){
        $this->args = $args;
    }
    public function connect(){
        $args = $this->args;
        $this->link =  mysql_connect($args['host'], $args['user'], $args['pwd']);
        if (!$this->link) {
            die('No pudo conectarse: ' . mysql_error());
        }
        mysql_select_db($args["db"]);        
        
    }
    public function close(){
        mysql_close($this->link);
    }
}

?>
