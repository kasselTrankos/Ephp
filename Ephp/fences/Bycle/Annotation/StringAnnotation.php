<?php
namespace Bycle\Annotation;
/**
 * Description of StringAnnotation from ephp.home
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
class StringAnnotation  extends Annotation
{
    
    public $length = 255;
    public $null = false;
    public $default ='void';
    public function initAnnotation($properties)
    {
        parent::initAnnotation($properties);
    }
}

?>
