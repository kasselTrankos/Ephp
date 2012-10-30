<?php
namespace Bycle\Annotation;
/**
 * Description of PrimaryAnnotation from ephp.home
 *
 * @author kassel
 */
use Annotation\Annotation;
use Annotation\AnnotationException;
use Annotation\IAnnotationParser;
/**
 * Specifies the required data-type of a property.
 *
 * @usage('property'=>true, 'inherited'=>true)
 */
class PrimaryAnnotation {
    public $autoincrement = true;
    public function initAnnotation($properties)
    {
        parent::initAnnotation($properties);
    }
}

?>
