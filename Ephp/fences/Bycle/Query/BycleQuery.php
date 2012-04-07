<?php
namespace Bycle\Query;
/**
 * Description of BycleQuery from ephp.home
 *
 * @author kassel
 */
use Bycle\Bycle;
use Annotation\Annotations;
class BycleQuery 
{   
    public function Entity($entity){
        $base= Annotations::ofClass($entity);
        return $base[0];
    }
}

?>
