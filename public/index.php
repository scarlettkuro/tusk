<?php

require __DIR__ . '/../vendor/autoload.php';

use framework\App;
use app\controllers\TaskController;
use framework\PDOFabric;

$params = [
    'enterpoint' => __DIR__,
    'viewpath' => '/../app/views/',
    'uploadpath' => '/upload/'
];

$app = new App($params);
$app->addComponent('pdo', PDOFabric::getPDO(parse_ini_file(__DIR__.'/../db.ini')));

$app->addRoutes( [
    '/' => [TaskController::class, 'index'],
    '/task' => [TaskController::class, 'task'],
    '/task/{id}' => [TaskController::class, 'task'],
    '/save' => [TaskController::class, 'save']
]);

echo $app->run();