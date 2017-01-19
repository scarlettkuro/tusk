<?php

require __DIR__ . '/../vendor/autoload.php';

use framework\App;
use app\controllers\TaskController;

$params = [
    'enterpoint' => __DIR__,
    'viewpath' => '/../app/views/',
    'uploadpath' => '/upload/',
    'dbparams' => [
        'driver' => 'mysql',
        'host' => 'localhost',
        'dbname' => 'tusk',
        'username' => 'root',
        'password' => '',
        'charset' => 'utf8'
    ]
];

$app = new App($params);
extract($app->params()['dbparams']);
$pdo = new PDO("$driver:host=$host;dbname=$dbname;charset=$charset", $username, $password);
$app->addComponent('pdo', $pdo);

$ctrl = new TaskController();

$app->addRoutes( [
    '/' => [$ctrl, 'index'],
    '/task' => [$ctrl, 'task'],
    '/task/{id}' => [$ctrl, 'task'],
    '/save' => [$ctrl, 'save'],
    '/json' => [$ctrl, 'json'],
    //'/create' => ['TaskController', 'create'],
    //'/edit/{id}' => ['TaskController', 'edit']
]);

echo $app->run();