<?php

/**
 * This file is part of the Pet.
 *
 * (c) Max Meiden Dasuki <max@littlelives.com>
 */

use Pet\WebBundle\Controller;

$app["controller.main"] = $app->share(function () use ($app) {
    return new Controller\MainController($app);
});


// ===== MAIN =====

$app->match("/", "controller.main:homepageAction")->bind("homepage");
