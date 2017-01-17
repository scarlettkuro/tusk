<?php

namespace app\controllers;

use \app\App;

class Controller {
    
    public function render($view, $params) {
        ob_start();
        ob_implicit_flush(false);
        extract($params, EXTR_OVERWRITE);
        require(App::app()->params()['viewpath'] . $view);
        return ob_get_clean();
    }
    
}

