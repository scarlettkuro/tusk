<?php

namespace app\controllers;

use framework\App;
use framework\Controller;
use app\models\User;

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
            'username' => 'admin',
            'password' => '123'
        ]);
        //die(var_dump()))
    }
    
    public function loogout() {
        App::app()->component('auth')->logout();
    }
}
