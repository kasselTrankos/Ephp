<?php
namespace LayerC\methods;

use Ephp\Form\Form;

class Forms
{
    private $args, $forms, $html='';
    private $func=array(
        'label' =>array('reg'=>'/(.+)\.label\(\'\s*(.+)\s*\'\)/', 'func'=>'getLabel'),
        'field' =>array('reg'=>'/(.+)\.field\(\'\s*(.+)\s*\'\)/', 'func'=>'getField'),
        'error' =>array('reg'=>'/(.+)\.error\(\'\s*(.+)\s*\'\)/', 'func'=>'getError')
    );

    public function __construct($args, $pattern)
    {
        $this->setForm($args);
        $this->method($pattern);
    }
    public function html ()
    {
        return $this->html;
    }
    private function setForm($args)
    {
        foreach ($args as $arg) 
            if($arg instanceof Form) $this->forms[$arg->getName()] = $arg;
    }
    public function method($text)
    {
        foreach ($this->func as $f)
        {
            if(preg_match($f["reg"], $text, $r))
            {
                return $this->{$f['func']}($this->forms[$r[1]], $r[2]);
            }
        }
    }
    private function getLabel($form, $name){$this->html = utf8_decode($form->getHtmlLabel($name));}
    private function getPiece(){}
    private function getField($form, $name){$this->html = $form->getHtmlField($name);}
    private function getError($form, $name){$this->html = $form->getFieldError($name);}
}
?>