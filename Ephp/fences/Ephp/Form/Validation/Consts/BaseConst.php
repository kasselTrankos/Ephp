<?php
namespace Ephp\Form\Validation\Consts;
/**
 * Description of BaseConst from ephp.home
 *
 * @author kassel
 */
class BaseConst {
    private $message;
    public function __construct($val)
    {
        $this->message = $val;
    }
    protected function message(){return $this->message;}
}

?>
