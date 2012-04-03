<?php
namespace Bycle\Query;
/**
 * Description of BycleQuery from ephp.home
 *
 * @author kassel
 */
use Bycle\Bycle;
use Bycle\Query\core\BycleSelect;
class BycleQuery 
{
    private $bycle;
    public function __construct($conn){
        $this->bycle = new Bycle($conn); 
    }
    public function Entity($entity){
        $this->entity = new $entity($this);
        return $this->entity;
        
    }
    public function Select($table, $args, $limit){
        $qsql = new BycleSelect();
        $sql = $qsql->Sql($table, $args, $this->entity, $limit);
        return $this->bycle->parseEntity_result($sql, $this->entity);        
    }
}

?>
