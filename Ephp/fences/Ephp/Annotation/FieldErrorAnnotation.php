<?php
namespace Ephp\Annotation;
/**
 * Description of FieldErrorAnnotation from ephp.home
 *
 * @author kassel
 */

/**
 * @usage('property'=>true, 'inherited'=>true)
 */
use Annotation\Annotation;
class FieldErrorAnnotation  extends Annotation{
    public $error;
}

?>
