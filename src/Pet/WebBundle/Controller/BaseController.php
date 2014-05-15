<?php

/**
 * This file is part of the Pet.
 *
 * (c) Max Meiden Dasuki <max@littlelives.com>
 */

namespace Pet\WebBundle\Controller;

use Silex\Application;
use Pet\WebBundle\Service\CheatService;
use Pet\WebBundle\Service\PetService;
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

    /**
     * Renders a template.
     *
     * @param string $name    The template name
     * @param array  $context An array of parameters to pass to the template
     * @return string The rendered template
     */
    public function renderTemplate($name, array $context = [])
    {
        return $this->app['twig']->render($name, $context);
    }

    /**
     * Adds a flash message for type.
     *
     * @param string $type
     * @param string $message
     */
    protected function setFlash($type, $message)
    {
        $this->app['session']->getFlashBag()->add($type, $message);
    }

    /**
     * Generates a URL or path for a specific route based on the given parameters.
     *
     * @param string $name       The name of the route
     * @param mixed  $parameters An array of parameters
     * @return string The generated URL
     */
    public function generateUrl($name, $parameters = [])
    {
        return $this->app['url_generator']->generate($name, $parameters);
    }

    protected function getCheatService()
    {
        return new CheatService($this->app);
    }

    protected function getPetService()
    {
        return new PetService($this->app);
    }

    protected function getUserService()
    {
        return new UserService($this->app);
    }
}
