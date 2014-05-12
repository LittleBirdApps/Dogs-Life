<?php

/**
 * This file is part of the Pet.
 *
 * (c) Max Meiden Dasuki <max@littlelives.com>
 */

$app = new Silex\Application();

$app->register(new Silex\Provider\ServiceControllerServiceProvider());

$app->register(new Silex\Provider\ValidatorServiceProvider());

return $app;
