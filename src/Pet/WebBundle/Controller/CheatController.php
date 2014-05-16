<?php

/**
 * This file is part of the Pet.
 *
 * (c) Max Meiden Dasuki <max@littlelives.com>
 */

namespace Pet\WebBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Pet\WebBundle\Constants;

/**
 * Class CheatController
 * @package Pet\WebBundle\Controller
 */
class CheatController extends BaseController
{

    public function componentSidebarAction()
    {
        return $this->renderTemplate('Component/sidebar.twig', ['game_time' => $this->getCheatService()->getGameTime()]);
    }

    public function resetTimeAction()
    {
        if ($this->app['config']['feature_cheat']) {
            $this->getCheatService()->resetTime();
        }

        return $this->app->redirect($this->generateUrl('home'));
    }

    public function timeAction($amount)
    {
        if ($this->app['config']['feature_cheat']) {
            $this->getCheatService()->addTime($amount);
        }

        return $this->app->redirect($this->generateUrl('home'));
    }

    public function zeroFoodAction()
    {
        if ($this->app['config']['feature_cheat']) {
            $petId = Constants::CONFIG_INITIAL_PET_ID;
            $this->getCheatService()->zeroFood($petId);
        }

        return $this->app->redirect($this->generateUrl('home'));
    }

    public function foodAction($amount)
    {
        if ($this->app['config']['feature_cheat']) {
            $petId = Constants::CONFIG_INITIAL_PET_ID;
            $this->getPetService()->addFood($petId, $amount);
        }

        return $this->app->redirect($this->generateUrl('home'));
    }

    public function zeroFullAction()
    {
        if ($this->app['config']['feature_cheat']) {
            $petId = Constants::CONFIG_INITIAL_PET_ID;
            $this->getCheatService()->zeroFull($petId);
        }

        return $this->app->redirect($this->generateUrl('home'));
    }

    public function fullAction($amount)
    {
        if ($this->app['config']['feature_cheat']) {
            $petId = Constants::CONFIG_INITIAL_PET_ID;
            $this->getCheatService()->addFull($petId, $amount);
        }

        return $this->app->redirect($this->generateUrl('home'));
    }

    public function zeroCleanAction()
    {
        if ($this->app['config']['feature_cheat']) {
            $petId = Constants::CONFIG_INITIAL_PET_ID;
            $this->getCheatService()->zeroClean($petId);
        }

        return $this->app->redirect($this->generateUrl('home'));
    }

    public function cleanAction($amount)
    {
        if ($this->app['config']['feature_cheat']) {
            $petId = Constants::CONFIG_INITIAL_PET_ID;
            $this->getCheatService()->addClean($petId, $amount);
        }

        return $this->app->redirect($this->generateUrl('home'));
    }
}
