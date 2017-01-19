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
        foreach ($this->routes as $route => $action) {
            $params = [];

            if (preg_match_all($this->regularize($route), $actualRoute, $params, PREG_SET_ORDER)) {
                array_shift($params[0]);
                return [$action, $params[0]];
            }

            //throw new Exception('404');
        }
    }
}
