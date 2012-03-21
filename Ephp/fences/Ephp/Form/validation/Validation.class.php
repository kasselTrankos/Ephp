<?php
namespace Ephp\Form\core;
/**
 * Description of Validation
 *
 * @author Kassel
 * @date 07-oct-2011 
 */
class Validation {
    public static function factory($type)
    {
        
        if (require_once dirname(__FILE__).'/lib/'.$type.'Validation.class.php') {
            $classname = $type.'Validation';
            return new $classname;
        } else {
            throw new Exception('Driver not found');
        }
    }
}

?>
