<?php
namespace Bycle\Entity;
use sfYaml\sfYaml;
use Bycle\Bycle;
use Bycle\Query\core\BycleSelect;
/**
 * Description of BycleEntity from ephp.home
 *
 * @author kassel
 */
use Annotation\Annotations;

class BycleEntity 
{
    private $entity, $bycle, $table, $db;
    
    public function __construct()
    {
        $conn = sfYaml::load(__DIR__.'/../../../app/mind.yml');
        $this->bycle = new Bycle($conn['database']);
        $this->db = $conn['database']['db'];
    }
    public function Select($args=NULL, $limit=NULL){
        $qsql = new BycleSelect();
        $sql = $qsql->Sql($this->db, $this->table, $this->entity, $args, $limit);
        return $this->bycle->parseEntity_result($sql, $this->entity);        
    }
    public function setEntity($entity){
        $this->entity= new $entity();
    }
    public function setTable($name){
        $this->table = $name;
    }
    public function find($args=NULL, $limit=NULL )
    {
        return $this->Select($args, $limit);
        
    }
    public function __call($name, $args)
    {
        $limit = NULL;
        if(preg_match('/^findBy$/', $name, $m))
            $arg = $args[0];
        if(preg_match('/(?<=^findBy)(.+)$/', $name, $m))
            $arg[strtolower($m[0])] = $args[0];
        
        if(preg_match('/(?<=^findOneBy)(.+)/', $name, $m))
        {
            $arg[strtolower($m[0])] = $args[0];  
            $limit = 1;            
        }
        if(preg_match('/^findAll$/', $name)){
            $arg = NULL;
        }
        return $this->find($arg, $limit);
                
    }
}

?>
