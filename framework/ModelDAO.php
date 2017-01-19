<?php

namespace framework;

use framework\App;
/**
 * Description of ModelDAO
 *
 * @author kuro
 */
class ModelDAO {
    
    private $pdo;
    private $modelClass;
    
    public function __construct($class) { 
        $this->pdo = App::app()->component('pdo');
        $this->modelClass = $class;
        /*$charset = "utf8";
        extract(App::app()->params()['dbparams']);
        $this->pdo = new PDO("$driver:host=$host;dbname=$dbname;charset=$charset", $username, $password);*/
    }
    
    public function readAll() {
        $table_name = call_user_func([$this->modelClass, 'table_name']);
        
        $statement = $this->pdo->query("SELECT * FROM $table_name" );
        $entities = [];
        while($entity = $statement->fetch(PDO::FETCH_CLASS, $this->modelClass)) {
            $entities[] = $entity;
        }
        
        return $entities;
    }
    
    public function read($id) {
        $table_name = call_user_func([$this->modelClass, 'table_name']);
        $pk= call_user_func([$this->modelClass, 'primary']);
        
        $sql = "SELECT * FROM $table_name WHERE $pk = :$pk";                      
        $statement = $this->pdo->prepare($sql); 
        $statement->bindParam(':' . $pk, $id /*, PDO::PARAM_STR*/);     
        $statement->execute(); 
        $entity = $statement->fetch(PDO::FETCH_CLASS, $this->modelClass);
        
        return $entity;
    }
    
    public function save($entity) {        
        if ($this->isNew($entity)) {
            $this->create($entity);
        } else {
            $this->update($entity);
        }
        
    }
    
    // - - -
    
    public function isNew($entity) {
        $pk = $entity->primary();
        
        return $entity->$pk == NULL;
    }
    
    public function create($entity) {
        $fields = array_diff($entity->fields(), [$entity-->primary()]);
        $table_name = $entity->table_name();
        
        $sql = "INSERT INTO $table_name (" . implode(", ", $fields) . ") VALUES (:" . implode(", :", $fields) . ")";                                 
        $statement = $this->pdo->prepare($sql);

        foreach($fields as $field) {                       
            $statement->bindParam(':' . $field, $this->$field /*, PDO::PARAM_STR*/);       
        }

        $statement->execute(); 
    }


    public function update($entity) {
        $fields = $entity->fields();
        $table_name = $entity->table_name();
        $pk = $entity->primary();
        
        $set = [];
        
        foreach($fields as $field) {                       
            $set[] = "$field = :$field";  
        }
        
        $sql = "UPDATE $table_name SET " . implode(", ", $set) . " WHERE $pk = :$pk";                              
        $statement = $this->pdo->prepare($sql);

        foreach($fields as $field) {                       
            $statement->bindParam(':' . $field, $entity->$field /*, PDO::PARAM_STR*/);       
        }

        $statement->execute(); 
    }
    
}
