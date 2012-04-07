<?php
namespace Ephp\Request;
/**
 * Description of Request from ephp.home
 *
 * @author kassel
 */
class Request {
    public function __construct(){
        
    }
    public function getPost(){
        return $_POST;
    }
}

?>
