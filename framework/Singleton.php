<?php

namespace framework;

/**
 * Description of Singleton
 *
 * @author kuro
 */
trait Singleton {
    
    protected static $_instance = NULL;
    
    final public static function instance() {
        return isset(static::$_instance) ? 
            static::$_instance : 
            static::$_instance = new static;
    }
    
    private function __construct() {
        $this->init();
    }
    
    protected function init() {
        //constructor
    }
    
    final private function __wakeup() {}
    final private function __clone() {}    

}
