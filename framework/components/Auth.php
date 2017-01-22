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
    
    private $userclass;
    
    public function __construct($userclass) {
        $this->userclass = $userclass;
    }
    
    public function attempt($where, $params) {
        $userDAO = new ModelDAO($this->userclass);
        $user = $userDAO->query($where, $params);
         return $user ? $this->login($user) : false;
    }
    
    public function login(ModelInterface $user) {
        $userDAO = new ModelDAO($this->userclass);
        if (!$userDAO->isNew($user)) {
            $pk = $user->primary();
            $_SESSION['user'] = $user->$pk;
            return true;
        }
        
        return false;
    }
    
    public function isUser() {
        return $_SESSION['user'] != NULL;
    }
    
    public function getUser() {
        $userDAO = new ModelDAO($this->userclass);
        return $userDAO->read($_SESSION['user']);
    }
    
    public function logout() {
        $_SESSION['user'] = NULL;
    }
    
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
