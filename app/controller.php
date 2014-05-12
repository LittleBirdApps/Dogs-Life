<?php

/**
 * This file is part of the Pet.
 *
 * (c) Max Meiden Dasuki <max@littlelives.com>
 */

use Pet\WebBundle\Controller;

$app["controller.user"] = $app->share(function () use ($app) {
    return new Controller\UserController($app);
});


// ===== USER =====

$app->put("/register", "controller.user:registerAction");

$app->get('/', function () {
    return 'Pet - Grow Your Pet';
});
