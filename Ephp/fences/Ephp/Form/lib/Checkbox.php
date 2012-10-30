<?php
namespace Ephp\Form\lib;
/**
 * Description of Checkbox from ephp.home
 *
 * @author kassel
 */
use Ephp\Form\lib\MyField;
class Checkbox extends MyField {
    public function __construct($name, $form){
        $html = '<input type="checkbox" name="{name}" id="{id}" />';
        $html = preg_replace('/\{name\}/', $form.'['.$name.']', $html);
        $html = preg_replace('/\{id\}/', $form.'_'.$name, $html);
        $this->html = $html;
        parent::__construct($name, $form);
    }
}

?>
