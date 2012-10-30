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
        $code = preg_replace('/\{name\}/' ,$form.'['.$name.']' ,$code);
        $this->html = preg_replace('/\{id\}/' ,$form.'_'.$name ,$code );
        parent::__construct($name, $form);
    }
    public function maxlength($val)
    {
        $re= " maxlength= \"".$val."\"";
        //max length
        $this->html = substr_replace($this->html, $re, strlen($this->html)-3, 0);
        
        return $this;
    }
    public function value($value)
    {
        parent::defaults($this->getValue($value));
        $this->html = substr_replace($this->html, $this->default, 26, 0);
        return $this;
    }
    public function defaults($value){
        $this->value($value);
        return $this;
    }
}
?>
