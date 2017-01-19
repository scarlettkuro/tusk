<?php

namespace framework;

/**
 *
 * @author kuro
 */
interface ModelInterface {
    
    static function table_name();
    static function fields();
    static function primary();
    
}
