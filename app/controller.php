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
$app->get("/cheat/time/{amount}", "controller.cheat:timeAction")->assert('amount', '\d+')->bind("cheat_time");
$app->get("/cheat/time/reset", "controller.cheat:resetTimeAction")->bind("cheat_reset_time");
$app->get("/cheat/food/{amount}", "controller.cheat:foodAction")->assert('amount', '\d+')->bind("cheat_food");
$app->get("/cheat/food/zero", "controller.cheat:zeroFoodAction")->bind("cheat_zero_food");
$app->get("/cheat/full/{amount}", "controller.cheat:fullAction")->assert('amount', '\d+')->bind("cheat_full");
$app->get("/cheat/full/zero", "controller.cheat:zeroFullAction")->bind("cheat_zero_full");
$app->get("/cheat/clean/{amount}", "controller.cheat:cleanAction")->assert('amount', '\d+')->bind("cheat_clean");
$app->get("/cheat/clean/zero", "controller.cheat:zeroCleanAction")->bind("cheat_zero_clean");

$app->get("/", "controller.pet:homeAction")->bind("home");

$app->get("/feed", "controller.pet:feedAction")->bind("feed");

$app->get("/bathe", "controller.pet:batheAction")->bind("bathe");
