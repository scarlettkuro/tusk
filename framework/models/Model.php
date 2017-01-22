<?php

namespace framework\models;

/**
 * Description of Models
 *
 * @author kuro
 */
trait Model {
    
    /**
     * Allow to get private properties and
     * use get methods to retrieve them
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
    
    /**
     * Allow to set private properties and
     * use set methods to populate them
     */
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
