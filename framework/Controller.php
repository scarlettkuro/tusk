<?php

namespace framework;

use framework\App;

trait Controller {
    
    use Singleton;
    
    public function render($view, $params) {
        $content = $this->renderView($view, $params);
        return $this->renderView('layout.php', ['content' => $content]);
    }
    
    public function renderView($view, $params) {
        ob_start();
        ob_implicit_flush(false);
        extract($params, EXTR_OVERWRITE);
        require(App::app()->params()['enterpoint'] . App::app()->params()['viewpath'] . $view);
        return ob_get_clean();
    }
    
    public function redirect($route) {
        if (is_array($route)) {
            $route = App::app()->route($route);
        }
        header("Location: $route");
        die();
    }
    
}

