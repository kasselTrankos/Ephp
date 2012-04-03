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
        $q = mysql_fetch_object($r);
        
        if(!$q) return $q; 
        foreach($q as $k=>$v)
            $entity->{$k}='$v'; 
            
        $this->close();
        return $entity;
    }
    
    
}

?>
