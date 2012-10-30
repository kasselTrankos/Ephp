<?php
namespace Ephp\Annotation;
use Ephp\session\Session;
use sfYaml\sfYaml;
/**
 * Description of SecuredAnnotation from ephp.home
 *
 * @author kassel
 */
/**
 * @usage('method'=>true)
 */
use Annotation\Annotation;
class SecuredAnnotation  extends Annotation 
{
    public $role="anonymous";
    
    public function initAnnotation($params)
    {
        parent::initAnnotation($params);
        $user = unserialize(Session::get('user'));
        $file = __DIR__.'/../../../app/mind.yml';
        $security = sfYaml::load($file);
        if($user->role != $this->role) header("Location:".$security['security']['login']);
    }
}

?>
