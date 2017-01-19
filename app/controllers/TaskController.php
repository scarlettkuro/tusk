<?php

namespace app\controllers;

use framework\ModelDAO;
use app\models\Task;
use framework\App;
use framework\Controller;

class TaskController {
    
    use Controller;
    
    public function index() {
        //$taskDAO = new ModelDAO(Task::class);
        //$taskDAO->readAll();
        
        $tasks = [];
        
        for($i = 0; $i < 8; $i++) {
            $task = new Task();
            $task->name = "Vlada Tepes";
            $task->email = "dracul.vamp@romana.com";
            $task->text = "Hírnevet az uralkodása alatti különös kegyetlenkedéseivel szerzett. Uralkodóként az Oszmán Birodalomtól független politikát folytatott és harcolt az oszmán terjeszkedés ellen. Éppen emiatt Romániában III. Vladot Havasalföld védelmezőjének tekintik.";
            $task->done =  rand(0,1) == 1;
            $tasks[]  = $task;
        }
                
        return $this->render('index.php', ['tasks' => $tasks]);
    }
    
    public function task() {
        $task = new Task();
        $task->name = "Vlada Tepes";
        $task->email = "dracul.vamp@romana.com";
        $task->text = "Hírnevet";
        $task->done = rand(0,1) == 1;
                
        return $this->render('task.php', ['task' => $task]);
    }
    
    public function save() {
        $task = new Task();
        $task->name = filter_input(INPUT_POST, 'name');
        $task->email = filter_input(INPUT_POST, 'email');
        $task->text = filter_input(INPUT_POST, 'text');
        $task->done = filter_input(INPUT_POST, 'done');
        $pic = $_FILES['pic'];
        $filename = App::app()->params()['uploadpath'] . time() . "." . pathinfo($pic['name'], PATHINFO_EXTENSION);
        move_uploaded_file($pic['tmp_name'], $filename);
        $task->pic = $filename;
        
        print_r($task);
    }
    
    public function json() {
        
        return json_encode([print_r($_FILE, true)]);
    }
    
}
