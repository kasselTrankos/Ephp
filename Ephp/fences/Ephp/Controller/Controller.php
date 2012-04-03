<?php
namespace Ephp\Controller;

use Ephp\Request\Request;
use Bycle\Bycle;
use Bycle\Query\BycleQuery;

class Controller
{

    private $server, $request, $ephp, $query=NULL, $posted;

    public function __construct($ephp)
    {
        $this->ephp = $ephp;
        $this->request = new Request();
        
    }
    
    public function get($val)
    {
        if(isset($_POST[$val])) return $_POST[$val];
        if(isset($_POST[key($_POST)][$val])) return $_POST[key($_POST)][$val];
        if(preg_match('/server/', $val))
            return $this->server->get($val);
        if(preg_match('/bycle/', $val))
            return $this->getBycle();
    }
    public function server($val){$this->server = $val;}
    public function getPost(){return $this->request->getPost();}
    
    /////PRIVATE
    private function getBycle()
    {
        if($this->query==NULL)
            $this->query = new BycleQuery($this->ephp->get("datebase"));
        return $this->query;
    }
}
?>