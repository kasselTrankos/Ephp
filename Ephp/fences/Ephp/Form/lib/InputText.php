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
    
    
    public function __construct($name, $form)
    {
        $code = "<input type=\"text\" value=\"\" name=\"{name}\" id=\"{id}\" />";
        $this->html = preg_replace('/\{name\}/' ,$form.'['.$name.']' ,$code);
        $this->html = preg_replace('/\{id\}/' ,$form.'_'.$name ,$code   );
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
