<?php

namespace app\models;

/**
 * Description of Models
 *
 * @author kuro
 */
trait Model {
    
    /*
    public function __call ($name , $arguments ) {
        if (substr($name,0,3) == 'get') {
            $property = $this->propertyName($name);
            if (property_exists($this, $property)) {
                echo $this->$property;
            }
        }
        
        if (substr($name,0,3) == 'set') {
            $property = $this->propertyName($name);
            if (property_exists($this, $property)) {
                $this->$property = $arguments[0];
            }
        }
    }
    
    private function propertyName($method_name, $prefix = 3) {
        return strtolower(substr($method_name,$prefix,1)) . 
                substr($method_name, $prefix+1);
    }
    */
    
    public function __set ($name , $value) {
        if (in_array($name, $this->fields())) {
            $method_name = 'set' . ucfirst($name);
            if (method_exists($this,  $method_name)) {
                call_user_func([$this,  $method_name], $value);
            } else {
                $this->$name = $value;
            }
        }
    }
    
    public function __get ($name) {
        if (in_array($name, $this->fields())) {
            $method_name = 'get' . ucfirst($name);
            if (method_exists($this,  $method_name)) {
                return call_user_func([$this,  $method_name]);
            } else {
                return $this->$name;
            }
        }
    }
}
