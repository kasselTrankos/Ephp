<?php
namespace Event\core;
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Event
 *
 * @author watson
 */
class Event implements ArrayAccess {
    protected
    $processed=false,
    $name='',
    $subject=null,
    $parameters=null;
    

    public function  __construct($suject, $name, $parameters=array()) {
        $this->subject=$suject;
        $this->name=$name;
        $this->parameters=$parameters;
    }
    public function getName(){
        return $this->name;
    }
    public function getSubject(){
        return $this->subject;
    }
    public function getParameters(){
        return $this->parameters;
    }
    public function setProcessed($value){
        $this->processed=(boolean) $value;
    }
    public function isProcessed(){
        return $this->processed;
    }

    /**
   * Returns true if the parameter exists (implements the ArrayAccess interface).
   *
   * @param  string  $name  The parameter name
   *
   * @return Boolean true if the parameter exists, false otherwise
   */
  public function offsetExists($name)
  {
    return array_key_exists($name, $this->parameters);
  }

  /**
   * Returns a parameter value (implements the ArrayAccess interface).
   *
   * @param  string  $name  The parameter name
   *
   * @return mixed  The parameter value
   */
  public function offsetGet($name)
  {
    if (!array_key_exists($name, $this->parameters))
    {
      throw new InvalidArgumentException(sprintf('The event "%s" has no "%s" parameter.', $this->name, $name));
    }

    return $this->parameters[$name];
  }

  /**
   * Sets a parameter (implements the ArrayAccess interface).
   *
   * @param string  $name   The parameter name
   * @param mixed   $value  The parameter value
   */
  public function offsetSet($name, $value)
  {
    $this->parameters[$name] = $value;
  }

  /**
   * Removes a parameter (implements the ArrayAccess interface).
   *
   * @param string $name    The parameter name
   */
  public function offsetUnset($name)
  {
    unset($this->parameters[$name]);
  }
}
?>
