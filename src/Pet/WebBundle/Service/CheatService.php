<?php

/**
 * This file is part of the Pet.
 *
 * (c) Max Meiden Dasuki <max@littlelives.com>
 */

namespace Pet\WebBundle\Service;

use Pet\WebBundle\Constants;

/**
 * Class CheatService
 * @package Pet\WebBundle\Service
 */
class CheatService extends BaseService
{
    /**
     * Get game time
     *
     * @return array
     */
    public function getGameTime()
    {
         $time = $this->getDB()->createQueryBuilder()
            ->select('sum(time) as total')
            ->from('cheat', 'c')
            ->execute()
            ->fetch();

        return mktime(date("H") + $time['total']);
    }

    /**
     * Add time
     *
     * @param time
     */
    public function addTime($time)
    {
        $this->getDB()->insert('cheat', ['time' => $time]);
    }
}
