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
 * Class UserController
 * @package Pet\WebBundle\Controller
 */
class UserController extends BaseController
{

    public function register(Request $request)
    {
        $userService = $this->getUserService();
        $userService->register();
    }
}
