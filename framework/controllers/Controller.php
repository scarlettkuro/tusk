<?php

namespace framework\controllers;

use framework\App;
use framework\Singleton;

trait Controller {
    
    use Singleton;
    
    /**
     * Render view to layout
     * @param String $view View name
     * @param Array $params Params for view
     * @return String Rendered view inside layout
     */
    public function render($view, $params = []) {
        $content = $this->renderView($view, $params);
        return $this->renderView('layout.php', ['content' => $content]);
    }
    
    /**
     * Render view
     * @param String $view View name
     * @param Array $params Params for view
     * @return String Rendered view
     */
    public function renderView($view, $params = []) {
        ob_start();
        ob_implicit_flush(false);
        extract($params, EXTR_OVERWRITE);
        require(App::app()->params()['enterpoint'] . App::app()->params()['viewpath'] . $view);
        return ob_get_clean();
    }
    
    /**
     * Redirect to route. Alias for App method
     * @param mixed $route Callable or url
     */
    public function redirect($route) {
        App::app()->redirect($route);
    }
    
}

