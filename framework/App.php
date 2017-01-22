<?php

namespace framework;

/**
 * Description of App
 *
 * @author kuro
 */
class App {
    
    //private $router;
    private $params;
    private $components;
    private static $app;
    private $middlewares = [];
    
    
    public function __construct($params = []) {
        session_start();
        $this->addComponent('router', new Router());
        //$this->router = $this->component('router');
        $this->params = $params;
        self::$app = $this;
    }
    
    public static function app() {
        return self::$app;
    }

    public function addRoute($route, $action) {
        $this->component('router')->addRoute($route, $action);
    }

    public function addRoutes($routes) {
        $this->component('router')->addRoutes($routes);
    }

    public function route($action, $params = []) {
        return $this->component('router')->route($action, $params);
    }

    public function run() {
        $route_action = $this->component('router')->dispatch($_SERVER['REQUEST_URI']);
        $middlewares = array_merge([
           function ($middlewares) use ($route_action) {
                return call_user_func_array($route_action[0], $route_action[1]);
           }
        ], $route_action[2] , $this->middlewares);
        
        $next = array_pop($middlewares);
        echo $next($middlewares);
    }
    
    public function params() {
        return $this->params;
    }
    
    public function addComponent($id, $component) {
        $this->components[$id] = $component;
    }
    
    public function component($id) {
        return $this->components[$id];
    }
    
    public function redirect($route) {
        if (is_array($route)) {
            $route = $this->route($route);
        }
        header("Location: $route");
        die();
    }
}
