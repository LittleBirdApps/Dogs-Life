<?php

/**
 * This file is part of the Pet.
 *
 * (c) Max Meiden Dasuki <max@littlelives.com>
 */

namespace Pet\WebBundle\Controller;

use Symfony\Component\HttpFoundation\Request;

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

    public function timeAction($time)
    {
        if ($this->app['config']['feature_cheat']) {
            $this->getCheatService()->addTime($time);
        }

        return $this->app->redirect($this->generateUrl('home'));
    }
}
