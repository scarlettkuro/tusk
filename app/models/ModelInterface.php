<?php

namespace app\models;

/**
 *
 * @author kuro
 */
interface ModelInterface {
    
    function table_name();
    public static function fields();
    public static function primary();
    
}
