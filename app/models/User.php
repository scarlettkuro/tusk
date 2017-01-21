<?php

namespace app\models;

use framework\UserInterface;
use framework\Model;

/**
 * Description of User
 *
 * @author kuro
 */
class User implements UserInterface {
    
    use Model;
    
    /** @property int id id */
    private $id;
    /** @property String name */
    private $username;
    /** @property String password */
    private $password;
    
    public function getPassword() {
        return NULL;
    }
    
    public static function table_name() {
        return 'users';
    }
    
    public static function fields() {
        return ['id', 'username', 'password'];
    }
    
    public static function primary() {
        return 'id';
    }
}
