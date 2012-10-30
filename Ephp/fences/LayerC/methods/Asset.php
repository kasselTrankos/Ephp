<?php
namespace LayerC\methods;
use LayerC\methods\ILayerC;

class Asset implements ILayerC
{
    private $html;
    public function __construct($asset, $code, $node){
            $this->html = $this->translate($asset, $code, $node);
    }
    public function get(){return $this->html;}
    private function translate($asset, $code, $tag)
    {
        $path = preg_replace('/\:/', '/', $asset);
        return substr_replace($code, $path, $tag['start'], $tag['length']);
    }

}
?>