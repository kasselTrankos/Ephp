<?php
namespace LayerC\methods;
/**
 * Description of Admon from ephp.home
 *
 * @author kassel
 */
use LayerC\methods\ILayerC;
class Admon  implements ILayerC
{
    private $html='';
    
    public function __construct($args, $pattern)
    {
        if(isset($_SESSION['user'])){
            $user = unserialize($_SESSION['user']);
            $this->html = $user->{$pattern};
        }
    }
    public function get(){ return $this->html;}
    
}

?>
