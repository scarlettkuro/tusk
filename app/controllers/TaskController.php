<?php

namespace app\controllers;

use framework\ModelDAO;
use app\models\Task;
use framework\App;
use framework\Controller;
use app\service\ImageProccessor;

class TaskController {
    
    use Controller;
    
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
            $task = new Task;
        }
                
        return $this->render('task.php', ['task' => $task]);
    }
    
    public function save() {
        $task = new Task();
        $task->id = filter_input(INPUT_POST, 'id');
        $task->name = filter_input(INPUT_POST, 'name');
        $task->email = filter_input(INPUT_POST, 'email');
        $task->text = filter_input(INPUT_POST, 'text');
        $task->done = filter_input(INPUT_POST, 'done') ? 1 : 0;
        //if (key_exists('pic', $_FILES)) {
            $pic = $_FILES['pic'];
        if (!$pic['error']) {
            $filename =  App::app()->params()['uploadpath'] . time() . "." . pathinfo($pic['name'], PATHINFO_EXTENSION);
            $fullname = App::app()->params()['enterpoint'] .  $filename;
            move_uploaded_file($pic['tmp_name'], $fullname );
            $imp = new ImageProccessor($fullname );
            $imp->resize(320, 240);
            $imp->save($fullname);
            $task->pic = $filename;
        }
        //print_r($task);
        //print_r($task->primary());
        $taskDAO = new ModelDAO(Task::class);
        $taskDAO->save($task);
                        
        return $this->index();
    }
    
    public function json() {
        
        return json_encode([print_r($_FILE, true)]);
    }
    
}
