<?php
namespace Bycle;
/**
 * Description of Bycle from ephp.home
 *
 * @author kassel
 */
use Bycle\core\BycleConnection;
use Bycle\core\BaseBycle;
use Bycle\Query\BycleQuery;

class Bycle extends BaseBycle
{
        
       
    public function parseEntity_result($sql, &$entity)
    {
        $this->open();
        $r = mysql_query($sql);
        $prop = get_object_vars($entity);
        $class = get_class($entity);
        $entities = array();
        while($Row = mysql_fetch_object($r))
        {
            $class = new  $class();
            foreach ($prop as $k=>$v){
                $class->{$k}=$Row->{$k};
            }
            $entities[] = $class;
        }
        if(count($entities)==0) return FALSE;
        if(count($entities)==1) return $entities[0];
        return $entities;
        
    }
    
    
}

?>
