<?php

require __DIR__ . '/../vendor/autoload.php';

use framework\App;
use app\controllers\TaskController;
use app\controllers\UserController;
use framework\PDOFabric;
use framework\Auth;
use app\models\User;
use framework\Flash;

$params = [
    'enterpoint' => __DIR__,
    'viewpath' => '/../app/views/',
    'uploadpath' => '/upload/'
];

$app = new App($params);
$app->addComponent('pdo', PDOFabric::getPDO(parse_ini_file(__DIR__.'/../db.ini')));
$app->addComponent('auth', new Auth(User::class));
$app->addComponent('flash', new Flash());

$app->addRoutes( [
    '/' => [TaskController::class, 'index'],
    '/task' => [TaskController::class, 'task'],
    '/task/{id}' => [TaskController::class, 'task'],
    '/save' => [TaskController::class, 'save'],
    '/auth' => [UserController::class, 'auth'],
    '/logout' => [UserController::class, 'logout']
]);

echo $app->run();