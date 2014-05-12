<?php

/**
 * This file is part of the Pet.
 *
 * (c) Max Meiden Dasuki <max@littlelives.com>
 */

$baseDir = dirname(__DIR__);

$app = new Silex\Application();

$app->register(new Silex\Provider\TwigServiceProvider(), [
    'twig.path' => $baseDir . '/src/Pet/WebBundle/Resource/view',
    'twig.options'  => [
        'cache' => $baseDir . '/app/cache/twig'
    ]
]);

$app->register(new Silex\Provider\UrlGeneratorServiceProvider());

$app->register(new Silex\Provider\SessionServiceProvider());

$app->register(new Silex\Provider\ServiceControllerServiceProvider());

$app->register(new Silex\Provider\ValidatorServiceProvider());

return $app;
