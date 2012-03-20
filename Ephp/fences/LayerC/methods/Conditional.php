<?php
namespace LayerC\methods;
class Conditional
{
	private $conds=array(
		"start_tag"=>'/\{\%\s*is(.+)\s*\%\}/',
		"more_tag"=>'/\{\%\s*elseis.*\%\}/',
		"end_tag"=>'/\{\%s*endis\s*\%\}/'
	);
	private $html ='', $sec, $args;

	public function Update($tags){
		$secuence=array();
		$c=-1;
		$more=0;
		foreach($tags as $tag){
			if(preg_match($this->conds['start_tag'], $tag['text'])){
				$c++;
				$secuence[$c][]=$tag;
				$more=0;				
			}
			if(preg_match($this->conds['more_tag'], $tag['text'])){
				$secuence[$c][]=$tag;
				$more++;
			}
			if(preg_match($this->conds['end_tag'], $tag['text'])){
				$secuence[$c][]=$tag;
				$more=0;
			}
		}
		return (count($secuence)>0) ?$secuence: NULL;
	}
	public function make($tags){return $this->Update($tags);}
	
	public function Execute($secuence, $code, $args)
	{
		$str='';		
		$from=$secuence[0]['start'];
		$to=$secuence[count($secuence)-1]['start']+$secuence[count($secuence)-1]['length']-$from;
		foreach ($secuence as $key => $v) {
			if($key<count($secuence)-1){
				$str.=$this->Compare($v, $secuence[$key+1], $args, $code, $key);
			}else{
				$str.='}';
			}
		}
		$re = eval($str);	
		$r=substr($code, $from, $to);
		$this->html = preg_replace('/'.preg_quote($r, '/').'/', $re, $code);
		return $this->html;
	}
	private function Compare($sec, $nxt, $args, $code, $key){
		preg_match_all('/\{\%\s*is\s*(.+)\s*\%\}/', $sec['text'], $m);
		$from=$sec['start']+$sec["length"];
		$to=$nxt['start']-$from;
		$in=substr($code, $from, $to);
		if($key==0)
		{
			if(preg_match('/(.+)\s*(\=\=)\s*(.+)|(.+)\s*(\!\=)\s*(.+)|(.+)\s*\=\=\=\s*(.+)/', $m[1][0], $q)){
				$if='if ($args["';
				$first=FALSE;
				for($i=1; $i<count($q);$i++){
					if($q[$i]!=''){
						if(!$first){
							$if.=$q[$i].'"]';
							$first=TRUE;
						}else{
							$if.=$q[$i];
						}
					}
				}
				return $if.'){  return "'.$in.'";';	
			}else{
				return 'if ($args["'.$m[1][0].'"]){  return "'.$in.'";';		
			}
		}else{
			if(preg_match_all('/\{\%\s*elseis\s*(.+)\s*\%\}/', $sec['text'], $m)){
				if(preg_match('/(.+)\s*(\=\=)\s*(.+)|(.+)\s*(\!\=)\s*(.+)|(.+)\s*\=\=\=\s*(.+)/', $m[1][0], $q)){
					$if=' } elseif ($args["';
					$first=FALSE;
					for($i=1; $i<count($q);$i++){
						if($q[$i]!=''){
							if(!$first){
								$if.=$q[$i].'"]';
								$first=TRUE;
							}else{
								$if.=$q[$i];
							}
						}
					}
					return $if.'){  return "'.$in.'";';	
				}else{
					return ' }else{  return "'.$in.'";';
				}	
			}
			
			return ' }else{  return "'.$in.'";';
		}
	}
}
?>