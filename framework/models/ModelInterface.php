<?php

namespace framework\models;

/**
 *
 * @author kuro
 */
interface ModelInterface {
    
    static function table_name();
    static function fields();
    static function primary();
    
}
