<?php

namespace framework\models;

/**
 *
 * @author kuro
 */
interface ModelInterface {
    
    /**
     * Returns name of the table for this model
     * @return String Table name
     */
    static function table_name();
    
    /**
     * Returns array of fields names, 
     * which can be used in with Model trait
     * @return Array Names of fields
     */
    static function fields();
    
    /**
     * Returns name of the primary key in table
     * @return String Name of the primary key
     */
    static function primary();
    
}
