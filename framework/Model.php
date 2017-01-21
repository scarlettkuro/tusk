<?php

namespace framework;

/**
 * Description of Models
 *
 * @author kuro
 */
trait Model {
    
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
