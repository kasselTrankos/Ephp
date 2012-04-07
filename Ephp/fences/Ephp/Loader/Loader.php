<?php
namespace Ephp\Loader;
/**
 * Description of Loader from ephp.home
 *
 * @author kassel
 */
use sfYaml\sfYaml;
class Loader {
    private $basepath='/../../../';
    private $mind = NULL;
    public function __construct(){
        $this->basepath = __DIR__.$this->basepath;
        $this->mind = sfYaml::load($this->basepath.'app/mind.yml');
    }
    public function get($what){
        if(isset($this->mind[$what])) return $this->mind[$what];
        return NULL;
    }
    //put your code here
}

?>
