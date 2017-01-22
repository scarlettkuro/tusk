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
    
    /** @var int $id id */
    private $id;
    /** @var String $name */
    private $name;
    /** @var String $email */
    private $email;
    /** @var String $text */
    private $text;
    /** @var String $pic */
    private $pic;
    /** @var bool $done */
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
