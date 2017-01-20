<?php

namespace framework;

class Router {

    private $routes = [];

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
                //die(print_r($params));
                
                $controller = call_user_func([$action[0], 'instance']);
                
                return [[$controller, $action[1]], $regular_params];
            }

            //throw new Exception('404');
        }
    }
    
    public function route($action, $params= []) {
        $patterns = array_keys($this->routes, $action);
        foreach ($patterns as $pattern) {
            if (preg_match_all('/\{(.*)\}/U', $pattern) == count($params)) {
                foreach($params as $i=>$param){
                    $pattern = preg_replace('/\{(.*)\}/U', $param, $pattern, 1);
                }
                return $pattern;
            }
        }
        
    }
}
