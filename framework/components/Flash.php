<?php

namespace framework\components;

/**
 * Description of Flash
 *
 * @author kuro
 */
class Flash {
    
    const SESSION_PARAM = 'flash';
    
    protected function init() {
        if (!isset($_SESSION[self::SESSION_PARAM])) {
            $_SESSION[self::SESSION_PARAM] = [];
        }
    }
       
    /**
     * Set flash message
     * @param String $flashname Name of the message
     * @param String $value Message
     */
    public function set($flashname, $value) {
        $_SESSION[self::SESSION_PARAM][$flashname] = $value;
    }
       
    /**
     * Retrieve flash message
     * @param String $flashname Name of the message
     * @return String message
     */
    public function get($flashname) {
        $value = $_SESSION[self::SESSION_PARAM][$flashname];
        unset($_SESSION[self::SESSION_PARAM][$flashname]);
        
        return $value;
    }
    
    /**
     * Checks if flash message exists
     * @param String $flashname Name of the message
     * @return boolean True if exist
     */
    public function exist($flashname) {
        return isset($_SESSION[self::SESSION_PARAM][$flashname]);
    }
}
