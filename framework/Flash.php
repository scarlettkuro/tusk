<?php

namespace framework;

/**
 * Description of Flash
 *
 * @author kuro
 */
class Flash {
    
    protected function init() {
        if (!$_SESSION['flash']) {
            $_SESSION['flash'] = [];
        }
    }
       
    public function set($flashname, $value) {
        $_SESSION['flash'][$flashname] = $value;
    }
       
    public function get($flashname) {
        $value = $_SESSION['flash'][$flashname];
        unset($_SESSION['flash'][$flashname]);
        
        return $value;
    }
    
    public function exist($flashname) {
        return isset($_SESSION['flash'][$flashname]);
    }
}
