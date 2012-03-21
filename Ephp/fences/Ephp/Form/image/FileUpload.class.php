<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ImageUpload
 *
 * @author Kassel
 * @date 05-sep-2011 
 */
class FileUpload {
    private $file, $name, $tmp, $type, $size, $error, $fname;
    private $path;
    const GIF="IMAGETYPE_GIF", JPG="IMAGETYPE_JPEG", JPEG="IMAGETYPE_JPEG", PNG="IMAGETYPE_PNG";
    public function __construct($name)
    {
        
        $this->name=$name;
        $key=key($_FILES);
        $this->file=$_FILES[$key];
        $this->tmp=$_FILES[$key]["tmp_name"][$this->name];
        $this->type=$_FILES[$key]["type"][$this->name];
        $this->size=$_FILES[$key]["size"][$this->name];
        $this->error=$_FILES[$key]["error"][$this->name];
        $this->fname=$_FILES[$key]["name"][$this->name];
        $this->getType();
    }
    public function validType($valid){
        return in_array($this->type, $valid);
    }
    public function getType(){
        return $this->type;
    }
    public function setPath($value){
        $this->path=$value;
    }
    public function Upload(){
        $file=$this->file; 
        
        $f["photho"]["name"]=$this->fname;
        $f["photho"]["type"]=$this->type;
        $f["photho"]["tmp_name"]=$this->tmp;
        $f["photho"]["error"]=$this->error;
        $f["photho"]["size"]=$this->size;
        
        
        
        $handle = new upload($f["photho"]);
        $handle->process($this->path);
        if ($handle->processed) {          
          $handle->clean();
          return true;
        } else {
            return false;
        }


        
                

    }
    
}

?>
