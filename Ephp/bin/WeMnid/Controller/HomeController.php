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
        if($login->isSubmitted())
        {
            $login->bind($this->getPost());
            if($login->isValid()){
                $q = $this->get("bycle")->Entity('WeMnid\Entity\Admon')
                ->findBy(array("name"=>$this->get("name"), "pwd"=>$this->get("pwd")));
                if($q!=FALSE){
                    echo " FOUND ";
                }else{
                    echo " NO FOUND";
                }
                /* ->findByName("ats");       
                if ($q!=false) print_r($q);
                else echo "pppp";
                 * 
                 */
            }
        }
        return array(
            'login'=>$login
        );
    }
}
?>