<?php

namespace app;

class Router {

	private $routes = [];

	public function regularize($pattern) {
		$pattern = preg_quote($pattern, '/');
		//$pattern = preg_replace('/\\\((.*)\\\)/U', '(.*)', $pattern);
		$pattern = preg_replace('/\\\{(.*)\\\}/U', '([0-9]*)', $pattern);
		return $pattern;
	}

	public function addRoute($route, $action) {
		$this->routes[$route] = $action;
	}

	public function addRoutes($routes) {
		$this->routes = array_merge($this->routes, $routes);
	}

	public function run() {

		$ACTUAL_ROUTE = $_SERVER['REQUEST_URI'];

		foreach ($this->routes as $route => $action) {
			$params = [];

			if (preg_match_all('/' . $this->regularize($route) . '$/U', $ACTUAL_ROUTE, $params, PREG_SET_ORDER)) {
				array_shift($params[0]);
				return call_user_func_array($action, $params[0]) . "\n";
			}

			//throw new Exception('404');
		}
	}
}
