<?php
namespace WeMnid\Form;
/**
 * Description of TagForm from ephp.home
 *
 * @author kassel
 */
use Ephp\Form\Form;
class TagForm extends Form{
    public function __construct($name)
    {
        parent::__construct($name);
        $this->append('text', 'name')->defaults("Tag name")->label("Add Tag");
        $this->append('text', 'uri')->defaults("URL")->label("Add Url");
    }
}

?>
