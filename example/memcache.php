<?php

require_once __DIR__.'/../vendor/autoload.php';

$app = new Silex\Application();

$app->register(new SilexMemcache\MemcacheExtension(), array(
    'memcache.server' => array(
        array('127.0.0.1', 11211)
    )
));

$app->get('/', function () use ($app) {
    $app['memcache']->set('test', time());
    return 'Memcache: "GET" "test" "' . $app['memcache']->get('test') . '"';
});

$app->run();
