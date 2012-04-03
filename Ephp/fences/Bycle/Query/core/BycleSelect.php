<?php
namespace Bycle\Query\core;
/**
 * Description of BycleSelect from ephp.home
 *
 * @author kassel
 */
class BycleSelect 
{
    public function Select()
    {
        
    }
    public function Sql($table, $args, $class, $limit=NULL)
    {
        $a = substr($table, 0, 1);
        $prop = get_object_vars($class);
        $sql = "SELECT ";
        foreach($prop as $key=>$val)
            $sql.= $a.'.'.$key.", ";        
        $sql=substr($sql, 0, strlen($sql)-2).' ';
        $sql.= ' FROM '.$table.' '.$a.' ';
        $fields = array_keys($args);
        $values = array_values($args);
        
        $sql.= ' WHERE '.$a.'.'.$fields[0].'="'.$values[0].'"';
        if(count($args)>1){
            for($i=1; $i<count($fields); $i++){
                $sql.= ' AND '.$a.'.'.$fields[$i].'="'.$values[$i].'"';
            }
        }
        if($limit != NULL ) $sql.=' LIMIT '.$limit;
        $sql.=';';
        return $sql;
    }
}

?>
