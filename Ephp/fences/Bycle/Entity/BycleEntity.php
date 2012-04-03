<?php
namespace Bycle\Entity;
/**
 * Description of BycleEntity from ephp.home
 *
 * @author kassel
 */

class BycleEntity 
{
    private $query;
    
    public function __construct($query){
        $this->query = $query;
       
    }
    public function find($args, $limit=NULL )
    {
        $class = get_class($this);
        $cPos  = strrpos($class, '\\');        
        $cName = substr($class, $cPos+1);
        return $this->query->Select(strtolower($cName), $args, $limit);
        
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
        return $this->find($arg, $limit);
                
    }
}

?>
