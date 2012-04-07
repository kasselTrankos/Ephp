<?php
namespace Ring;
/**
 * Description of Event from ephp.home
 *
 * @author kassel
 */
class Event 
{
    private $name, $params=array();
    public function __construct($name, $params){
        $this->name = $name;
        $this->params = $params;
    }
    public function getParams(){
        return $this->params;
    }
    public function getName(){return $this->name;}
}

?>
