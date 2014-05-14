<?php

/**
 * This file is part of the Pet.
 *
 * (c) Max Meiden Dasuki <max@littlelives.com>
 */

use Pet\WebBundle\Controller;

$app["controller.pet"] = $app->share(function () use ($app) {
    return new Controller\PetController($app);
});


// ===== MAIN =====

$app->get("/", "controller.pet:homeAction")->bind("home");

$app->get("/feed", "controller.pet:feedAction")->bind("feed");
