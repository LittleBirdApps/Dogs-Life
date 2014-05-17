<?php

/**
 * This file is part of the Pet.
 *
 * (c) Max Meiden Dasuki <max@littlelives.com>
 */

namespace Pet\WebBundle\Service;

use Doctrine\DBAL\Connection;
use Silex\Application;

/**
 * Class BaseService
 * @package Pet\ApiBundle\Service
 */
class BaseService
{
    protected $app;

    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    /**
     * @param array $array
     * @return array
     */
    protected function escapeValuesInArray(array $array)
    {
        return array_map(function($val) {
            return $this->getDB()->quote($val);
        }, $array);
    }

    /**
     * @return Connection
     */
    public function getDB()
    {
        return $this->app['db'];
    }

    /**
     * @return CheatService
     */
    protected function getCheatService()
    {
        return new CheatService($this->app);
    }

    /**
     * @return PetService
     */
    protected function getPetService()
    {
        return new PetService($this->app);
    }

    /**
     * @return UserService
     */
    protected function getUserService()
    {
        return new UserService($this->app);
    }

    /**
     * @return UtilityService
     */
    protected function getUtilityService()
    {
        return new UtilityService($this->app);
    }
}
