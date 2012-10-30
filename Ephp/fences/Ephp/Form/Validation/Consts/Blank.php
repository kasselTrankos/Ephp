<?php
namespace Ephp\Form\Validation\Consts;
/**
 * Description of Blank from ephp.home
 *
 * @author kassel
 */
use Ephp\Form\Validation\Consts\BaseConst;

class Blank extends BaseConst
{
    public function Valid($value)
    {
        return (empty($value) || strlen($value)==0 || $value==NULL);            
    }
    
}

?>
