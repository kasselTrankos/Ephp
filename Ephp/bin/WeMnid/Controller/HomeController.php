<?php
namespace WeMnid\Controller;
/**
* 
*/
use Ephp\Controller\Controller;
use WeMnid\Form\LoginForm;

class HomeController extends Controller
{
	
	public function IndexAction()
	{
		$login = new LoginForm("login");

		///print_r($this->get('server.name'));	
		return array(
			'login'=>$login

		);
	}
}
?>