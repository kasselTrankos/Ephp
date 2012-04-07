<?php
/**
* Self engine template for php
*/
namespace LayerC;
use LayerC\lib\Translate;
use LayerC\lib\Loader;

class LayerC
{
    public function __construct($route, $vars=NULL)
    {
        new Translate(Loader::load($route->template()), $route, $vars);
    }
}
?>