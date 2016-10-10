<?php

require_once __DIR__ . '/../vendor/autoload.php';

$app = new Silex\Application();
$app['debug'] = true;

$app->register(new Silex\Provider\ServiceControllerServiceProvider());



$app->get('/', function () {
    return '<h1>hello</h1>';
});

$app->run();
