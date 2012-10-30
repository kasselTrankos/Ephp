<?php
namespace WeMnid\Entity;
/**
 * Description of Admon from ephp.home
 *
 * @author kassel
 */
use Bycle\Annotation as ORM;
/**
 *@ORM\Entity ('table'=>'admon', 'entity'=>'WeMnid\Entity\Admon')
 */
class Admon
{
    /**
     *@ORM\Primary 
     */
    public $id;
    /**
    * @ORM\String ('length'=>125, 'default'=>'alvaro')
    */
    public $name="pepe";
    /**
     *@ORM\String ('length'=>45, 'default'=>'test') 
     */
    public $pwd;
    /**
     *@ORM\String ('length'=>45, 'default'=>'test') 
     */
    public $role;
    
    public $created_at;
}

?>
