<?php
namespace ATSUser;
/**
 * Description of User from ephp.home
 *
 * @author kassel
 */
use Ring\EventListener;
use WeMnid\Entity\Admon;
use Ephp\session\Session;
class User {
    public function __construct(){
        EventListener::Listener()->bind('on.userLogin', array($this, 'addToSession'));
        
    }
    public function addToSession(Admon $user, Session $session)
    {
        $session->Add("user", serialize($user));
    }
}

?>
