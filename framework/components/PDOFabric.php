<?php

namespace framework\components;

use \PDO;

/**
 * Description of PDOFabric
 *
 * @author kuro
 */
class PDOFabric {
    
    public static function getPDO($params) {
        extract($params);
        return new PDO(
            "$driver:host=$host;dbname=$dbname;charset=$charset", 
            $username, 
            $password,
            [
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
            ]
        );
    }
}
