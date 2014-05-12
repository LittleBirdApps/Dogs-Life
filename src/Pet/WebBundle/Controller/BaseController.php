<?php

/**
 * This file is part of the Pet.
 *
 * (c) Max Meiden Dasuki <max@littlelives.com>
 */

namespace Pet\WebBundle\Controller;

use Silex\Application;
use Pet\WebBundle\Service\UserService;

/**
 * Class BaseController
 * @package Pet\WebBundle\Controller
 */
class BaseController
{
    protected $app;

    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    protected function getUserService()
    {
        return new UserService($this->app);
    }
}
