<?php
namespace Bycle\core;
/**
 * Description of BaseBycle from ephp.home
 *
 * @author kassel
 */
use Bycle\Query\BycleQuery;

class BaseBycle 
{
    protected $core, $entity;
    private $query=NULL;    
    
    public function __construct($conn){
        $this->core= new BycleConnection($conn);
    } 
    protected function open(){
        $this->core->connect();
    }
    protected function close(){
        $this->core->close();
    }
}

?>
