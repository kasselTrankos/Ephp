<?php

/**
 * Description of UploadFile
 *
 * @author Kassel
 * @date: 05.09.2011
 */
class File   extends BaseField {
    private $html="<input type=\"file\" name=\"{name}\" size=\"{size}\" id=\"{id}\" /> ";
    public function __construct($form, $name, $args, $submitted){
        parent::__construct($form, $this->html, $name, $args, $submitted);
    }
}

?>
