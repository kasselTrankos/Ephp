<?php
namespace Ephp\Form\Validation\Consts;
/**
 * Description of URL from ephp.home
 *
 * @author kassel
 */
use Ephp\Form\Validation\Consts\BaseConst;
class URL extends BaseConst{
    public function Valid($value){
        return !preg_match('/(?<!\S)(((f|ht){1}tp[s]?:\/\/|(?<!\S)www\.)[-a-zA-Z0-9@:%_\+.~#?&\/\/=]+)/', $value);
    }
}

?>
