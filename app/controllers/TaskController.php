<?php

namespace app\controllers;

use framework\App;
use framework\models\ModelDAO;
use framework\controllers\Controller;
use app\models\Task;
use app\service\ImageProccessor;

class TaskController {
    
    use Controller;
    
    protected function init() {
        //constructor
    }
    
    public function index() {
        $taskDAO = new ModelDAO(Task::class);
        $tasks = $taskDAO->readAll();
                
        return $this->render('index.php', ['tasks' => $tasks]);
    }
    
    public function task($id = NULL) {
        $task = NULL;
        if ($id != NULL) {
            $taskDAO = new ModelDAO(Task::class);
            $task = $taskDAO->read($id);
        } else {
            $task = new Task();
        }
                
        return $this->render('task.php', ['id' => $id, 'task' => $task]);
    }
    
    public function save($id = NULL) {
        $taskDAO = new ModelDAO(Task::class);
        $task = $id ? $taskDAO->read($id) : new Task();
        
        
        $fields = array_diff(Task::fields(), ['id', 'pic']);
        foreach($fields as $field) {
            $task->$field = filter_input(INPUT_POST, $field);
        }
        
        $pic = $_FILES['pic'];
        if (!$pic['error']) {
            $filename =  App::app()->params()['uploadpath'] . time() . "." . pathinfo($pic['name'], PATHINFO_EXTENSION);
            $fullname = App::app()->params()['enterpoint'] .  $filename;
            move_uploaded_file($pic['tmp_name'], $fullname);
            $imp = new ImageProccessor($fullname);
            $imp->resize(320, 240);
            $imp->save($fullname);
            $task->pic = $filename;
        }
        
        $taskDAO->save($task);
                        
        $this->redirect([TaskController::class, 'index']);
    }
    
}
