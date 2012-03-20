<?php
namespace Ephp\Url;
class Url
{
	private $server;

	public function __construct(){
		$this->server=$_SERVER;
	}

	public function get($val){
		//print_r($this->server);
		if($val === 'server') return $this->server;
		if(preg_match('/server\..+/', $val)){
			preg_match('/server\.(.+)/', $val, $m);
			if($m[1] === "name") return $this->server["SERVER_NAME"];
			if($m[1] === "url") return $this->server["REQUEST_URI"];
		}

	}
	public function getURI(){return $this->server["REQUEST_URI"];}
}
?>