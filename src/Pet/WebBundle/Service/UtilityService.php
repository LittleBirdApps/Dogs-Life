<?php

/**
 * This file is part of the Pet.
 *
 * (c) Max Meiden Dasuki <max@littlelives.com>
 */

namespace Pet\WebBundle\Service;

use Pet\WebBundle\Constants;

/**
 * Class UtilityService
 * @package Pet\WebBundle\Service
 */
class UtilityService extends BaseService
{
    /**
     * Get game time
     *
     * @param int $type
     * @return mixed
     */
    public function getGameTime($type = Constants::CONFIG_GAME_TIME_TYPE_STRING)
    {
        if ($this->app['config']['feature_cheat']) {
            $time = $this->getCheatService()->getGameTime();
        } else {
            $time = time();
        }

        if ($type == Constants::CONFIG_GAME_TIME_TYPE_INT) {
            return $time;
        } else {
            return date("Y-m-d H:i:s", $time);
        }

    }
}
