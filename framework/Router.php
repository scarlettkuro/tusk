<?php

namespace framework;

class Router {

    private $routes = [];
    private $defaultRoute;

    public function regularize($pattern) {
        $pattern = preg_quote($pattern, '/');
        //$pattern = preg_replace('/\\\((.*)\\\)/U', '(.*)', $pattern);
        $pattern = preg_replace('/\\\{(.*)\\\}/U', '([0-9]*)', $pattern);
        $pattern = '/' . $pattern . '$/U';
        return $pattern;
    }

    public function addRoute($route, $action) {
        $this->routes[$route] = $action;
    }

    public function addRoutes($routes) {
        $this->routes = array_merge($this->routes, $routes);
    }

    public function dispatch($actualRoute) {
        $regularRoute = explode('?', $actualRoute)[0];
        
        foreach ($this->routes as $route => $action) {
            $matches = [];

            if (preg_match_all($this->regularize($route), $regularRoute, $matches, PREG_SET_ORDER)) {
                array_shift($matches[0]);
                $regular_params = $matches[0];
                
                //including GET params
                //$get_params = array_values(filter_input_array (INPUT_GET));
                //$params = array_merge($regular_params, $get_params);
                
                $hasMiddlewares = is_array($action[0]);
                $actionCallback = $hasMiddlewares ? array_shift($action) : $action; 
                $middlewares = $hasMiddlewares ? $action : [];
                
                $controller = call_user_func([$actionCallback[0], 'instance']);
                
                return [[$controller, $actionCallback[1]], $regular_params, $middlewares];
            }

            //throw new Exception('404');
        }
    }
    
    public function route($action, $params= []) {
        $patterns = [];
        foreach ($this->routes as $pattern => $paction) {
            $actionCallback = is_array($paction[0]) ? $paction[0] : $paction;
            if ($actionCallback == $action) {
                $patterns[] = $pattern;
            }
        }
        
        foreach ($patterns as $pattern) {
            if (preg_match_all('/\{(.*)\}/U', $pattern) == count($params)) {
                foreach($params as $i=>$param){
                    $pattern = preg_replace('/\{(.*)\}/U', $param, $pattern, 1);
                }
                return $pattern;
            }
        }
        
    }
    
    public function defaultRoute() {
        return isset($this->defaultRoute) ? 
            $this->defaultRoute :
            '/'/*array_shift($this->routes)*/;
    }
}
