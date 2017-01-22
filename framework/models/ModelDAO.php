<?php

namespace framework\models;

use framework\App;
use framework\models\ModelInterface;
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
    }
    
    public function readAll() {  
        $table_name = call_user_func([$this->modelClass, 'table_name']);
        
        $sql = "SELECT * FROM $table_name";
        
        $statement = $this->pdo->prepare($sql);
        
        $statement->execute() or $this->sqlException($statement);
        
        $statement->setFetchMode(\PDO::FETCH_CLASS, $this->modelClass);
        $entities =  $statement->fetchAll();
        
        return $entities;
    }
    
    public function read($id) {
        $pk = call_user_func([$this->modelClass, 'primary']);
        
        return $this->query("$pk = :id", ['id' => $id]);
    }
    
    public function query($where, $params) { 
        $table_name = call_user_func([$this->modelClass, 'table_name']);
        
        $sql = "SELECT * FROM $table_name WHERE $where";    
        
        $statement = $this->pdo->prepare($sql);   
        
        foreach($params as $key=>$value) {
            $statement->bindValue(":$key", $value);
        }
        
        $statement->execute() or $this->sqlException($statement);
        
        $statement->setFetchMode(\PDO::FETCH_CLASS, $this->modelClass);
        
        return $statement->fetch();
    }
    
    public function save(ModelInterface $entity) {        
        if ($this->isNew($entity)) {
            $this->create($entity);
        } else {
            $this->update($entity);
        }
        
    }
    
    public function isNew(ModelInterface $entity) {
        $pk = $entity->primary();
        
        return $entity->$pk == NULL;
    }
    
    public function create(ModelInterface $entity) {
        $fields = array_diff($entity->fields(), [$entity->primary()]);
        $table_name = $entity->table_name();
        
        $keys = implode(", ",$fields);
        $set_list = implode(", :", $fields);
        
        $sql = "INSERT INTO $table_name ($keys) VALUES (:$set_list)";   
        //die(print_r($values, true));
        $statement = $this->pdo->prepare($sql);
        
        foreach($fields as $field) {
            $statement->bindParam(":$field", $entity->$field);
        }
        
        $statement->execute() or $this->sqlException($statement);
    }


    public function update(ModelInterface $entity) {
        $fields = $entity->fields();
        $pk = $entity->primary();
        $table_name = $entity->table_name();
        
        $set = [];
        
        foreach($fields as $field) {                       
            $set[] = "$field = :$field";
        }
        
        $set_list = implode(", ", $set);
        
        $sql = "UPDATE $table_name SET $set_list WHERE $pk = :$pk";                              
        $statement = $this->pdo->prepare($sql);
        
        foreach($fields as $field) {
            $statement->bindParam(":$field", $entity->$field);
        }
        
        $statement->execute() or $this->sqlException($statement);
    }
    
    public function sqlException ($statement) {
        throw new \Exception($statement->errorInfo()[2]);
    }
    
}
