<?php

namespace app\models;

use framework\models\ModelInterface;
use framework\models\Model;
/**
 * Description of Task
 *
 * @author kuro
 */
class Task implements ModelInterface {
    
    use Model;
    
    /** @property int id id */
    private $id;
    /** @property String name */
    private $name;
    /** @property String email */
    private $email;
    /** @property String text */
    private $text;
    /** @property String pic */
    private $pic;
    /** @property bool done */
    private $done;
    
    public function setDone($value) {
        $this->done = $value ? 1 : 0;
    }
    
    public static function table_name() {
        return 'tasks';
    }
    
    public static function fields() {
        return ['id', 'name', 'email', 'text', 'pic', 'done'];
    }
    
    public static function primary() {
        return 'id';
    }
    
}
