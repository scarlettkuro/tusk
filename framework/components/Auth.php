<?php

namespace framework\components;

use framework\models\ModelInterface;
use framework\models\ModelDAO;

/**
 * Description of Auth
 *
 * @author kuro
 */
class Auth {
    
    /** @var class $userclass User model class */
    private $userclass;
    
    const SESSION_PARAM = 'user';
    
    /**
     * @param Class $userclass User model class
     */
    public function __construct($userclass) {
        $this->userclass = $userclass;
    }
    
    /**
     * Try to authorize user by quering it from repo
     * @param String $where Part of SQL query after 'WHERE'
     * @param Array $params Values for query to bind
     * @return boolean Success
     */
    public function attempt($where, $params) {
        $userDAO = new ModelDAO($this->userclass);
        $user = $userDAO->query($where, $params);
         return $user ? $this->login($user) : false;
    }
    
    /**
     * Authorize user.
     * @param ModelInterface $user User model
     * @return String Route regex.
     */
    public function login(ModelInterface $user) {
        $userDAO = new ModelDAO($this->userclass);
        if (!$userDAO->isNew($user)) {
            $pk = $user->primary();
            $_SESSION[self::SESSION_PARAM] = $user->$pk;
            return true;
        }
        
        return false;
    }
    
    /**
     * Checks, if user is authorized
     * @return boolean Is authorized.
     */
    public function isUser() {
        return $_SESSION[self::SESSION_PARAM] != NULL;
    }
    
    /**
     * Returns authorized user
     * @return ModelInterface Authorized user
     */
    public function getUser() {
        $userDAO = new ModelDAO($this->userclass);
        return $userDAO->read($_SESSION[self::SESSION_PARAM]);
    }
    
    /**
     * Logout user
     */
    public function logout() {
        $_SESSION[self::SESSION_PARAM] = NULL;
    }
    
    /**
     * Middleware method : prevents unauthorized actions
     * @param Array $middlewares List of unused middlewares
     * @return String Responce body
     */
    public function __invoke($middlewares) {
        //while request        
        if ($this->isUser()) {
        //go next
            $next = array_pop($middlewares);        
            echo $next($middlewares);
        } else {
            App::app()->component('flash')->set('auth', 'Not enough permissions.');
            App::app()->redirect(App::app()->component('router')->defaultRoute());
        }
        //while responce
    }
    
}
