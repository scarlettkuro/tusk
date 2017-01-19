<?php

require __DIR__ . '/../vendor/autoload.php';

$params = [
    'viewpath' => __DIR__ . '/../app/views/',
    'uploadpath' => __DIR__ . '/upload/',
    'dbparams' => [
        'driver' => '',
        'host' => '',
        'dbname' => '',
        'username' => '',
        'password' => '',
    ]
];

$app = new framework\App($params);

$ctrl = new app\controllers\TaskController();

$app->addRoutes( [
    '/' => [$ctrl, 'index'],
    '/task' => [$ctrl, 'task'],
    '/save' => [$ctrl, 'save'],
    '/json' => [$ctrl, 'json'],
    //'/create' => ['TaskController', 'create'],
    //'/edit/{id}' => ['TaskController', 'edit']
]);

echo $app->run();