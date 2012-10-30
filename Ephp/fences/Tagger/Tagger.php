<?php
namespace Tagger;
/**
 * Description of Tagger from ephp.home
 *
 * @author kassel
 */
class Tagger 
{
    private $tag, $uri, $path;
    
    public function __construct($tag, $uri, $path=""){
        $this->path=($path!="") ? $path: __DIR__.'/tags';
        $this->tag = $tag; 
        $this->uri = $uri;
        if(!file_exists($this->path)) mkdir ($this->path, 0777);
        $this->Create();
    }
    private function Create(){
        $php="<?php\n";
        $php.="namespace Tagger;\n";
        $php.="use Tagger\\BaseTag;\n";
        $php.="class ".ucwords($this->tag)."Tag extends BaseTag{\n";
        $php.="\tprivate \$uri=\"".$this->uri."\";\n";
        $php.="\tprivate \$tag=\"".$this->tag."\";\n";
        $php.="\tpublic function __construct(){\n";
        $php.="\t}\n";
        $php.="}\n";        
        $php.="?>";
        $file = $this->path.'/'.\ucwords($this->tag)."Tag.php";
        file_put_contents($file, $php, LOCK_EX);
    }
}

?>
