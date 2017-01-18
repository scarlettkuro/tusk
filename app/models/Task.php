<?php

namespace app\models;
/**
 * Description of Task
 *
 * @author kuro
 */
class Task implements ModelInterface {
    
    use Model;
    
    private $id = NULL;
    private $name;
    private $email;
    private $text;
    
    public static function table_name() {
        return 'task';
    }
    
    public static function fields() {
        return ['id', 'name', 'email', 'text'];
    }
    
    public static function primary() {
        return 'id';
    }
    
}
