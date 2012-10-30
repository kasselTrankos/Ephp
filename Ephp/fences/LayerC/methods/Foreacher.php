<?php
namespace LayerC\methods;
/**
 * Description of Foreach from ephp.home
 *
 * @author kassel
 */
//TODO: realizar mas completa esta clase con: Anidaciones, bucles numericos
use LayerC\methods\ILayerC;
class Foreacher implements ILayerC{
    private $html='';
    private $_for=array();
    private $_ffor=array('start'=>'/^\{\%\s*foreach\s*.+\%\}$/', 'end'=>'/^\{\%\s*endforeach\s*\%\}$/');
    public function __construct($code, $pattern, $load, $tags, $currTag, $args)
    {
        $arg = $this->getArg($pattern, $args);
        $found = $this->Range($tags);
        $this->Parse($code, $found, $arg, $pattern);
    }
    
    public function get(){
        return $this->html;
        
   }
    private function getArg($pattern, $args){
        preg_match('/^\{\%\s*foreach\s*(.+)\s*as/', $pattern, $m);
        return $args[trim($m[1])];
    }
    private function Parse($code, $found, $arg, $pattern)
    {
        $named = preg_match('/as\s*(.+)\s*\%/', $pattern, $m);
        $replaceArg =trim($m[1]);
        $start = $found['start']['start']+$found['start']['length'];
        $length = $found['end']['start']-$start;
        $html = substr($code, $start, $length);
        $re = $this->ReplaceFor($html, $replaceArg, $arg);
        $s = $found['start']['start'];
        $l = $found['end']['start']+$found['end']['length']-$s;
        $this->html = substr_replace($code, $re, $s, $l);
    }
    private function Range($tags)
    {
        $start = FALSE; $end = FALSE;
        for($i =0 ; $i<count($tags); $i++){
            if(!$start && preg_match($this->_ffor['start'], $tags[$i]['text'])){
                $_for['start'] = $tags[$i];
                $start=TRUE;
            }
            if(!$end && preg_match($this->_ffor['end'], $tags[$i]['text'])){
                $_for['end'] = $tags[$i];
                $end=TRUE;
            }
            if($start && $end) break;
        }
        return $_for;
    }
    private function ReplaceFor($code, $nameArg, $arg){
        
        $html = '';
        foreach ($arg as $obj){
            $html.= $this->Compute(get_object_vars($obj), $nameArg, $code);            
        }
        return $html;        
    }
    private function Compute($prop, $name, $code){
        foreach($prop as $key=>$val){
            $re = '/\{\{'.$name.'\.'.$key.'\}\}/';
            if(preg_match($re, $code)){
                $code=preg_replace($re, $val, $code);                
            }    
        }
        return $code;
    }
}
?>
