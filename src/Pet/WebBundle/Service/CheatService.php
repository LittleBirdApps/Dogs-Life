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
     * @return int
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
        $gameTime = $this->getUtilityService()->getGameTime();
        $this->getDB()->executeQuery('TRUNCATE cheat');
        $this->getDB()->update('pet', ['last_feed' => $gameTime, 'last_bathe' => $gameTime, 'last_online' => $gameTime], ['1' => '1']);
    }

    /**
     * Zero food
     *
     * @param $petId
     */
    public function zeroFood($petId)
    {
        $this->getPetService()->savePet($petId, ['food' => 0]);
    }

    /**
     * Zero full
     *
     * @param $petId
     */
    public function zeroFull($petId)
    {
        $this->getPetService()->savePet($petId, ['full' => 0]);
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
        $this->getPetService()->savePet($petId, ['full' => $amount]);
    }

    /**
     * Zero clean
     *
     * @param $petId
     */
    public function zeroClean($petId)
    {
        $this->getPetService()->savePet($petId, ['clean' => 0]);
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
        $this->getPetService()->savePet($petId, ['clean' => $amount]);
    }

    /**
     * Zero star
     *
     * @param $petId
     */
    public function zeroStar($petId)
    {
        $this->getPetService()->savePet($petId, ['star' => 0]);
    }

    /**
     * Add star
     *
     * @param $petId
     * @param $amount
     */
    public function addStar($petId, $amount)
    {
        $pet = $this->getPetService()->getPet($petId);
        if ($pet['star'] + $amount < 0) {
            $amount = 0;
        } else {
            $amount += $pet['star'];
        }
        $this->getPetService()->savePet($petId, ['star' => $amount], ['id' => $petId]);
    }

    /**
     * Zero clean
     *
     * @param $petId
     * @param $type
     */
    public function evolve($petId, $type)
    {
        $this->getPetService()->savePet($petId, ['type_id' => $type]);
    }
}
