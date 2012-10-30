<?php
namespace Ephp\Form\Validation\Consts;
/**
 * Description of BaseConst from ephp.home
 *
 * @author kassel
 */
class BaseConst {
    private $message, $args;
    public function __construct($val)
    {
        $this->message = (is_string($val)) ? $val : $val["message"];
        $this->args = (is_string($val)) ?  array() : $this->setArgs($val);
    }
    public function getArgs($value){
        
        $args["value"] = $value;
        $new = $args + $this->args;
        return $new;
    }
    private function setArgs($val){
        if(isset($val["message"])) unset($val["message"]);
        return $val;
    }
    public function message(){return $this->message;}
}

?>
