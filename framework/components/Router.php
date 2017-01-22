<?php

namespace framework\components;

class Router {

    private $routes = [];
    private $defaultRoute;

    /**
     * Make regex from route pattern.
     * @param String $pattern Route pattern
     * @return String Route regex.
     */
    public function regularize($pattern) {
        $pattern = preg_quote($pattern, '/');
        $pattern = preg_replace('/\\\((.*)\\\)/U', '(.*)', $pattern); //numeric
        $pattern = '/' . $pattern . '$/U';
        return $pattern;
    }

    /**
     * Adds route.
     * @param String Route pattern
     * @param Callable $route Array of two elements: class of the controller
     * and name of action.
     */
    public function addRoute($route, $action) {
        $this->routes[$route] = $action;
    }

    /**
     * Adds routes.
     * @param Callable[] $routes Array of routes. Route is array of two elements: 
     * class of the controller and name of action.
     */
    public function addRoutes($routes) {
        $this->routes = array_merge($this->routes, $routes);
    }

    /**
     * Matching route from url.
     * @param String $url URL
     * @return Array Callable route (controller and action), 
     * params, passed for route,
     * middleware.
     */
    public function dispatch($url) {
        $regularRoute = explode('?', $url)[0];
        
        foreach ($this->routes as $route => $action) {
            $matches = [];

            if (preg_match_all($this->regularize($route), $regularRoute, $matches, PREG_SET_ORDER)) {
                array_shift($matches[0]);
                $regular_params = $matches[0];
                
                $hasMiddlewares = is_array($action[0]);
                $actionCallback = $hasMiddlewares ? array_shift($action) : $action; 
                $middlewares = $hasMiddlewares ? $action : [];
                
                $controller = call_user_func([$actionCallback[0], 'instance']);
                
                return [[$controller, $actionCallback[1]], $regular_params, $middlewares];
            }
        }
    }
    
    /**
     * Create url for route 
     * @param Callable $action Array of two elements: class of the controller
     * and name of action.
     * @param Array Params to pass in route.
     * @return String URL
     */
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
    
    /**
     * Default url
     * @return String Default URL
     */
    public function defaultRoute() {
        return isset($this->defaultRoute) ? 
            $this->defaultRoute :
            '/'/*array_shift($this->routes)*/;
    }
}
