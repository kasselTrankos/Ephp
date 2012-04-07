<?php
namespace WeMnid\Controller;
use Ephp\Controller\Controller;
use WeMnid\Form\LoginForm;

class UserController extends Controller
{
    public function LoginAction()
    {
        $login = new LoginForm("login");
        if($login->isSubmitted())
        {
            $login->bind($this->getPost());
            if($login->isValid()){
                $q = $this->get("bycle")->Entity('WeMnid\Entity\Admon')
                ->findBy(array("name"=>$this->get("name"), "pwd"=>$this->get("pwd")));
                
                if($q!=FALSE){
                    $this->get('ring')->run('on.userLogin', array("user"=>$q));
                    $this->Redirect('_home');
                    //echo " FOUND ";
                }else{
                   // echo " NO FOUND";
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