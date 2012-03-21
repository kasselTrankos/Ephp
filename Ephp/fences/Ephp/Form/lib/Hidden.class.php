<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Hidden
 *
 * @author Kassel
 * @date 10-sep-2011 
 */
class Hidden extends BaseField {
    private $html="<input type=\"hidden\" name=\"{name}\" id=\"{id}\" value=\"{value}\" /> ";
    public function __construct($form, $name, $args, $submitted){
        parent::__construct($form, $this->html, $name, $args, $submitted);
    }
}

?>
