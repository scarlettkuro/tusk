<?php

require __DIR__ . '/../vendor/autoload.php';

$params = [
  'viewpath' => __DIR__ . '/../views/',
];

$app = new app\App($params);

$ctrl = new app\controllers\TaskController();

$app->addRoutes( [
    '/' => [$ctrl, 'index'],
    //'/create' => ['TaskController', 'create'],
    //'/edit/{id}' => ['TaskController', 'edit']
]);

echo $app->run();