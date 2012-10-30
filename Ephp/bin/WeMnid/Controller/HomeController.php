<?php
namespace WeMnid\Controller;
/**
* 
*/
use Ephp\Controller\Controller;
use WeMnid\Form\LoginForm;
use Ring\EventListener;
use Ephp\Annotation as Security;
use Tagger\Tagger;

use WeMnid\Form\TagForm;

class HomeController extends Controller
{	
    /**
     *
     * @Security\Secured('role'=>'ROLE_ADMON')
     */
    public function HomeAction()
    {        
        $proyects = $this->get("bycle")->Entity('WeMnid\Entity\Proyects')->findAll();
        $form = new TagForm('tags');
        if($form->isSubmitted())
        {
            if($form->isValid())
            {
                new Tagger($this->get('name'), $this->get('uri'));
            }else{
                
            }
        }
        return array(
            'proyects'=>$proyects,
            'form_tag'=>$form
        );        
    }    
}
?>