<?php

namespace app\models;

use framework\models\ModelInterface;
use framework\models\Model;

/**
 * Description of User
 *
 * @author kuro
 */
class User implements ModelInterface {
    
    use Model;
    
    /** @var int $id id */
    private $id;
    /** @var String $name */
    private $username;
    /** @var String $password */
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
