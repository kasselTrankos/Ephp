<?php

return array(
  'WeMnid\\Entity\\Proyects' => array(
    array('Bycle\\Annotation\\EntityAnnotation', 'table'=>'proyects', 'entity'=>'WeMnid\Entity\Proyects')
  ),
  'WeMnid\\Entity\\Proyects::$id' => array(
    array('Bycle\\Annotation\\PrimaryAnnotation')
  ),
  'WeMnid\\Entity\\Proyects::$name' => array(
    array('Bycle\\Annotation\\StringAnnotation', 'length'=>125, 'default'=>'name of proyect')
  ),
);
