<?php

return array(
  'WeMnid\\Entity\\Admon' => array(
    array('Bycle\\Annotation\\EntityAnnotation', 'table'=>'admon', 'entity'=>'WeMnid\Entity\Admon')
  ),
  'WeMnid\\Entity\\Admon::$id' => array(
    array('Bycle\\Annotation\\PrimaryAnnotation')
  ),
  'WeMnid\\Entity\\Admon::$name' => array(
    array('Bycle\\Annotation\\StringAnnotation', 'length'=>125, 'default'=>'alvaro')
  ),
  'WeMnid\\Entity\\Admon::$pwd' => array(
    array('Bycle\\Annotation\\StringAnnotation', 'length'=>45, 'default'=>'test')
  ),
);
