<?php

/**
 * This file is part of the Pet.
 *
 * (c) Max Meiden Dasuki <max@littlelives.com>
 */

$app['config'] = [
    'environment'   => 'prod',
];

$app->register(new Silex\Provider\DoctrineServiceProvider(), [
    'db.options'    => [
        'driver'    => 'pdo_mysql',
        'dbname'    => 'pet',
        'host'      => '127.0.0.1',
        'user'      => 'root',
        'password'  => '123456'
    ]
]);
