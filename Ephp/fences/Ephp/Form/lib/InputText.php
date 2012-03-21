<?php
namespace Ephp\Form\lib;
/**
 * Description of InputText
 *
 * @author Kassel
 */
use Ephp\Form\lib\MyField;


class InputText extends MyField 
{
    
    private $html="<input type=\"text\" value=\"\" name=\"{name}\" id=\"{id}\" />";
    public function __construct($name, $form)
    {
        $this->html = preg_replace('/\{name\}/' ,$form.'['.$name.']' ,$this->html);
        $this->html = preg_replace('/\{id\}/' ,$form.'_'.$name ,$this->html);
    }
    public function maxlength($val)
    {
        $re= " maxlength= \"".$val."\"";
        $this->html = substr_replace($this->html, $re, strlen($this->html)-3, 0);
        return $this;
    }
    public function value($val)
    {
        $this->html = substr_replace($this->html, $val, 26, 0);
        return $this;
    }
}
?>
