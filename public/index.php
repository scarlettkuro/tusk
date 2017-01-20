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
$pdo = new PDO("$driver:host=$host;dbname=$dbname;charset=$charset", $username, $password,[
    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
  ]);
$app->addComponent('pdo', $pdo);


$app->addRoutes( [
    '/' => [TaskController::class, 'index'],
    '/task' => [TaskController::class, 'task'],
    '/task/{id}' => [TaskController::class, 'task'],
    '/save' => [TaskController::class, 'save']
]);

echo $app->run();