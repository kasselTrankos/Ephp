<?php
namespace Bycle\Annotation;
/**
 * Description of EntityAnnotation from ephp.home
 *
 * @author kassel
 */
use Annotation\Annotation;
use Annotation\AnnotationException;
use Bycle\core\BaseBycle;
use Bycle\Entity\BycleEntity;

/**
 * @usage('class'=>true, 'property'=>true, 'method'=>true, 'inherited'=>true, 'multiple'=>true, 'bycle'=>true)
 */
class EntityAnnotation extends Annotation 
{
    
    public $bycle, $entity, $table;
    
    public function initAnnotation($params)
    {
        
        $params['bycle']=new BycleEntity();
        parent::initAnnotation($params);
        $this->bycle->setTable($this->table);
        $this->bycle->setEntity($this->entity);
    }
    public function __call($name, $args)
    {
        
        //$spec["bycle"] = new BycleEntity();
        return call_user_func_array(array($this->bycle, $name), $args);
    }
}

?>
