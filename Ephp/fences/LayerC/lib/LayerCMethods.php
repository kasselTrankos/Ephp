<?php
namespace LayerC\lib;

use LayerC\lib\BaseMethods;
use LayerC\methods\Extend;
use LayerC\methods\Includes;
use LayerC\methods\Asset;
use LayerC\methods\Routes;
use LayerC\methods\Foreacher;

class LayerCMethods extends BaseMethods
{
    public function __construct($code, $tags, $route, $args){
            $this->add_layerc_method(array(
                    'extends' => array(
                            "class"  =>  $this, 
                            'method' => '_Extends',
                            'pattern'=> '/\{\%\s*extends\s*\'(.+)\'\s*\%\}/'
            )));
            $this->add_layerc_method(array(
                    'include' => array(
                            "class"  =>  $this, 
                            'method' => '_Include',
                            'pattern'=> '/\{\%\s*include\s*\'(.+)\'\s*\%\}/'
            )));
            $this->add_layerc_method(array(
                    'asset' => array(
                            "class"  =>  $this, 
                            'method' => '_Asset',
                            'pattern'=> '/\{\%\s*asset\s*\(\'(.+)\'\)\s*\%\}/'
            )));
            $this->add_layerc_method(array(
                    'route' => array(
                            "class"  =>  $this, 
                            'method' => '_Route',
                            'pattern'=> '/\{\%\s*route\s*\(\'(.+)\'\)\s*\%\}/'
            )));
            $this->add_layerc_method(array(
                'foreacher' => array(
                "class"  =>  $this, 
                'method' => '_Foreach',
                'pattern'=> '/\{\%\s*foreach\s*(.+)\s*\%\}/'
            )));
            parent::__construct($code, $tags, $route, $args);
    }		

    public function _Extends ($tag, $load, $tags, $currTag, $args)
    {
        $extends = new Extend();
        return $extends->Execute($this->getHtml(), $load, $tags);
    }
    public function _Include($tag, $load, $tags, $currTag, $args)
    {
        $include = new Includes($load, $this->getHtml(), $currTag);
        return $include->get();
    }
    public function _Asset($pattern, $load, $tags, $currTag, $args)
    {
        $asset = new Asset($load, $this->getHtml(), $currTag);
        return $asset->get();
    }
    public function _Route($pattern, $load, $tags, $currTag, $args)
    {
        $route = new Routes($load, $this->getHtml(), $currTag, $this->getRoute());
        return $route->get();
    }
    public function _Foreach($pattern, $load, $tags, $currTag, $args){
       
        $_foreach = new Foreacher($this->getHtml(), $pattern, $load, $tags, $currTag, $args);
        return $_foreach->get();
    }
}
?>