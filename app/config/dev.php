<?php

/**
 * This file is part of the Pet.
 *
 * (c) Max Meiden Dasuki <max@littlelives.com>
 */

$app['debug'] = true;

$app['config'] = [
    'environment'   => 'dev',
];

$app->register(new Silex\Provider\DoctrineServiceProvider(), [
    'db.options'    => [
        'driver'    => 'pdo_mysql',
        'dbname'    => 'pet',
        'host'      => 'localhost',
        'user'      => 'root',
        'password'  => ''
    ]
]);
