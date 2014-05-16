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
     * @param $amount
     */
    public function addTime($amount)
    {
        $this->getDB()->insert('cheat', ['time' => $amount]);
    }

    /**
     * Reset time
     */
    public function resetTime()
    {
        $this->getDB()->executeQuery('TRUNCATE cheat');
    }

    /**
     * Zero food
     *
     * @param $petId
     */
    public function zeroFood($petId)
    {
        $this->getDB()->update('pet', ['food' => 0], ['id' => $petId]);
    }

    /**
     * Zero full
     *
     * @param $petId
     */
    public function zeroFull($petId)
    {
        $this->getDB()->update('pet', ['full' => 0], ['id' => $petId]);
    }

    /**
     * Add full
     *
     * @param $petId
     * @param $amount
     */
    public function addFull($petId, $amount)
    {
        $pet = $this->getPetService()->getPet($petId);
        if ($pet['full'] + $amount < 0) {
            $amount = 0;
        } else if ($pet['full'] + $amount > Constants::CONFIG_MAX_FULL) {
            $amount = Constants::CONFIG_MAX_FULL;
        } else {
            $amount += $pet['full'];
        }
        $this->getDB()->update('pet', ['full' => $amount], ['id' => $petId]);
    }

    /**
     * Zero clean
     *
     * @param $petId
     */
    public function zeroClean($petId)
    {
        $this->getDB()->update('pet', ['clean' => 0], ['id' => $petId]);
    }

    /**
     * Add clean
     *
     * @param $petId
     * @param $amount
     */
    public function addClean($petId, $amount)
    {
        $pet = $this->getPetService()->getPet($petId);
        if ($pet['full'] + $amount < 0) {
            $amount = 0;
        } else if ($pet['clean'] + $amount > Constants::CONFIG_MAX_CLEAN) {
            $amount = Constants::CONFIG_MAX_CLEAN;
        } else {
            $amount += $pet['clean'];
        }
        $this->getDB()->update('pet', ['clean' => $amount], ['id' => $petId]);
    }
}
