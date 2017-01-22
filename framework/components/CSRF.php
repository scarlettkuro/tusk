<?php

namespace framework\components;

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
    
    public function getToken() {
        return $_SESSION[self::SESSION_PARAM];
    }
    
    public function getTokenParam() {
        return self::POST_PARAM;
    }
    
    public function checkToken($token) {
        return $_SESSION[self::SESSION_PARAM] === $token;
    }
    
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
