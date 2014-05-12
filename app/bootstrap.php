<?php

/**
 * This file is part of the Pet.
 *
 * (c) Max Meiden Dasuki <max@littlelives.com>
 */

require_once __DIR__.'/../vendor/autoload.php';

$env = getenv('PET_ENV');
if (!empty($env) && $env == 'prod') {
    $loader = new Symfony\Component\ClassLoader\ApcUniversalClassLoader("pet");
} else {
    $loader = new Symfony\Component\ClassLoader\UniversalClassLoader();
}

$loader->registerNamespace('Pet', __DIR__.'/../src');

$loader->register();

return $loader;
