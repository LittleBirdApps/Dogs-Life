<?php

/**
 * This file is part of the Pet.
 *
 * (c) Max Meiden Dasuki <max@littlelives.com>
 */

use Pet\WebBundle\Controller;

$app["controller.cheat"] = $app->share(function () use ($app) {
    return new Controller\CheatController($app);
});
$app["controller.pet"] = $app->share(function () use ($app) {
    return new Controller\PetController($app);
});


// ===== MAIN =====
$app->get("/component/sidebar", "controller.cheat:componentSidebarAction")->bind("component_sidebar");
$app->get("/cheat/time/{time}", "controller.cheat:timeAction")->bind("cheat_time");

$app->get("/", "controller.pet:homeAction")->bind("home");

$app->get("/feed", "controller.pet:feedAction")->bind("feed");
