<?php

namespace app\controllers;

class TaskController extends Controller {
    
    use Controller;
    
    public function index() {
        return $this->render('index.php', ['username' => 'Vlada']);
    }
    
}
