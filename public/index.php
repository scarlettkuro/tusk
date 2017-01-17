<?php

require __DIR__ . '/../vendor/autoload.php';

use app\Router;

class TestController {
	public static function aaa() {
		//echo $a;
		return 'cc';
	}
	public static function a_ltyn($a, $b) {
		//echo $a;
		return $a * $b;
	}
}

$router = new Router();

$router->addRoutes( [
	'/' => ['TestController', 'aaa'],
	'mehmed/{one}/my-{two}-son' => ['TestController', 'a_ltyn'],
	'mehmed/{one}/my/{two}' => ['TestController', 'a_ltyn']
]);


echo $router->run();

