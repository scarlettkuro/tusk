<?php

namespace framework;

use framework\UserInterface;
use framework\ModelDAO;

/**
 * Description of Auth
 *
 * @author kuro
 */
class Auth {
    
    private $userclass;
    
    public function __construct($userclass) {
        $this->userclass = $userclass;
        session_start();
    }
    
    public function attempt($where, $params) {
        $userDAO = new ModelDAO($this->userclass);
        $user = $userDAO->query($where, $params);
        return $this->login($user);
    }
    
    public function login(UserInterface $user) {
        $userDAO = new ModelDAO($this->userclass);
        if (!$userDAO->isNew($user)) {
            $pk = $user->primary();
            $_SESSION['user'] = $user->$pk;
            return true;
        }
        
        return false;
    }
    
    public function isUser() {
        //die(var_dump($_SESSION['user']));
        return $_SESSION['user'] != NULL;
    }
    
    public function getUser() {
        $userDAO = new ModelDAO($this->userclass);
        return $userDAO->read($_SESSION['user']);
    }
    
    public function logout() {
        $_SESSION['user'] = NULL;
    }
    
}
