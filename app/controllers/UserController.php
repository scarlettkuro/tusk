<?php

namespace app\controllers;

use framework\App;
use framework\Controller;

/**
 * Description of UserController
 *
 * @author kuro
 */
class UserController {
    
    use Controller;
    
    protected function init() {
        //constructor
    }
    
    public function auth() {
        $auth = App::app()->component('auth');
        $auth->attempt("username = :username AND password = :password",  [
            'username' => filter_input(INPUT_POST, 'username'),
            'password' => filter_input(INPUT_POST, 'password')
        ]);
        //die(var_dump(App::app()->component('auth')->isUser()));
        $this->redirect([TaskController::class, 'index']);
    }
    
    public function logout() {
        App::app()->component('auth')->logout();
        //die(var_dump(App::app()->component('auth')->isUser()));
        $this->redirect([TaskController::class, 'index']);
    }
}
