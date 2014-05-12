<?php

/**
 * This file is part of the Pet.
 *
 * (c) Max Meiden Dasuki <max@littlelives.com>
 */

namespace Pet\WebBundle\Controller;

use Silex\Application;

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
}
