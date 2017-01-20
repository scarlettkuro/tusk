<?php

namespace framework;

/**
 * Description of App
 *
 * @author kuro
 */
class App {
    
    private $router;
    private $params;
    private $components;
    private static $app;
    
    
    public function __construct($params = []) {
        $this->router = new Router();
        $this->params = $params;
        self::$app = $this;
    }
    
    public static function app() {
        return self::$app;
    }

    public function addRoute($route, $action) {
        $this->router->addRoute($route, $action);
    }

    public function addRoutes($routes) {
        $this->router->addRoutes($routes);
    }

    public function route($action, $params = []) {
        return $this->router->route($action, $params);
    }

    public function run() {
        $route_action = $this->router->dispatch($_SERVER['REQUEST_URI']);
        echo call_user_func_array($route_action[0], $route_action[1]);
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
}
