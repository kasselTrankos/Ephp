<?php
namespace WeMnid\Entity;
/**
 * Description of Proyects from ephp.home
 * 
 * @author kassel
 */
use Bycle\Annotation as ORM;
/**
 *@ORM\Entity ('table'=>'proyects', 'entity'=>'WeMnid\Entity\Proyects')
 */
class Proyects {
    /**
     *@ORM\Primary 
     */
    public $id;
    /**
    * @ORM\String ('length'=>125, 'default'=>'name of proyect')
    */
    public $name="pepe";
    
}

?>
