<?php
namespace WeMnid\Controller;
/**
* 
*/
use Ephp\Controller\Controller;
use WeMnid\Form\LoginForm;
use Ring\EventListener;

class HomeController extends Controller
{	
    public function HomeAction()
    {
        
        $proyects = $this->get("bycle")->Entity('WeMnid\Entity\Proyects')->findAll();
        return array(
            'proyects'=>$proyects
        );
        
    }    
}
?>