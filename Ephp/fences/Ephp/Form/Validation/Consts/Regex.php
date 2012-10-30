<?php
namespace Ephp\Form\Validation\Consts;
/**
 * Description of Regex from ephp.home
 *
 * @author kassel
 */
use Ephp\Form\Validation\Consts\BaseConst;
class Regex extends BaseConst
{
     public function Valid($value, $pattern, $match=true)
    {
        return preg_match($pattern, $value)==$match;
    }
}

?>
