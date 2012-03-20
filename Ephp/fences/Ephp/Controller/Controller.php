<?php
namespace Ephp\Controller;
class Controller
{

	private $server;

	public function __construct()
	{
		
	}
	public function get($val)
	{
		if(preg_match('/server/', $val)){
			return $this->server->get($val);
		}
	}
	public function server($val){$this->server = $val;}
}
?>