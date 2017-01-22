<?php

require __DIR__ . '/../vendor/autoload.php';

use framework\App;
use app\controllers\TaskController;
use app\controllers\UserController;
use framework\components\PDOFabric;
use framework\components\Auth;
use framework\components\Flash;
use framework\components\CSRF;
use app\models\User;

$params = [
    'enterpoint' => __DIR__,
    'viewpath' => '/../app/views/',
    'uploadpath' => '/upload/'
];

$app = new App($params);
$app->addComponent('pdo', PDOFabric::getPDO(parse_ini_file(__DIR__.'/../db.ini')));
$auth = new Auth(User::class);
$app->addComponent('auth', $auth);
$csrf = new CSRF();
$app->addComponent('csrf', $csrf);
$app->addComponent('flash', new Flash());

$app->addRoutes( [
    '/' => [TaskController::class, 'index'],
    '/create' => [TaskController::class, 'task'],
    '/edit/{id}' => [[TaskController::class, 'task'], $auth],
    '/save' => [TaskController::class, 'save'],
    '/save/{id}' => [[TaskController::class, 'save'], $auth, $csrf],
    '/auth' => [[UserController::class, 'auth'], $csrf],
    '/logout' => [UserController::class, 'logout']
]);

$app->run();