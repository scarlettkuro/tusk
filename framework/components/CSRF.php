<?php

namespace framework\components;

use framework\App;

/**
 * Description of CSRF
 *
 * @author kuro
 */
class CSRF {
    
    const SESSION_PARAM = 'csrf';
    const POST_PARAM = '_csrf';
    
    public function __construct() {
        if (!isset($_SESSION[self::SESSION_PARAM])) {
            $_SESSION[self::SESSION_PARAM] = md5(time());
        }
    }
    
    /**
     * Returns CSRF token
     * @return String CSRF token
     */
    public function getToken() {
        return $_SESSION[self::SESSION_PARAM];
    }
    
    /**
     * Returns name of the token in POST data
     * @return String POST param name
     */
    public function getTokenParam() {
        return self::POST_PARAM;
    }
    
    /**
     * Validates token
     * @param String $token Token
     * @return boolean Returns true, if token match
     */
    public function checkToken($token) {
        return $_SESSION[self::SESSION_PARAM] === $token;
    }
    
    /**
     * Middleware. Prevents actions without CSRF token
     * @param Array $middlewares Unused middlewares
     * @return String Responce body
     */
    public function __invoke($middlewares) {
        //while request        
        if ($this->checkToken(filter_input(INPUT_POST, self::POST_PARAM))) {
        //go next
            $next = array_pop($middlewares);        
            echo $next($middlewares);
        } else {
            App::app()->redirect(App::app()->component('router')->defaultRoute());
        }
        //while responce
    }
}
