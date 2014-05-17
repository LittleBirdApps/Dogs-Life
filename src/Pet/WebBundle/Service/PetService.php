<?php

/**
 * This file is part of the Pet.
 *
 * (c) Max Meiden Dasuki <max@littlelives.com>
 */

namespace Pet\WebBundle\Service;

use Pet\WebBundle\Constants;

/**
 * Class PetService
 * @package Pet\WebBundle\Service
 */
class PetService extends BaseService
{
    /**
     * Get all pets
     *
     * @return array
     */
    public function getAllPets()
    {
        return $this->getDB()->createQueryBuilder()
            ->select('*')
            ->from('pet', 'p')
            ->execute()
            ->fetchAll();
    }

    /**
     * Get pet's data by id
     *
     * @param int $petId
     * @return array
     */
    public function getPet($petId)
    {
        return $this->getDB()->createQueryBuilder()
            ->select('*')
            ->from('pet', 'p')
            ->from('type', 't')
            ->where('p.id = :pet_id')
            ->andWhere('p.type_id = t.id')
            ->setParameter('pet_id', $petId)
            ->execute()
            ->fetch();
    }

    /**
     * Feed pet by id
     *
     * @param int $petId
     * @return int
     */
    public function feedPet($petId)
    {
        $pet = $this->getPet($petId);
        $this->savePet($petId, ['food' => $pet['food'] - 1, 'full' => $pet['full'] + 1, 'last_feed' => $this->getUtilityService()->getGameTime()]);
    }

    /**
     * Bathe pet by id
     *
     * @param int $petId
     * @return int
     */
    public function bathePet($petId)
    {
        $this->savePet($petId, ['clean' => Constants::CONFIG_MAX_CLEAN, 'last_bathe' => $this->getUtilityService()->getGameTime()]);
    }

    /**
     * Cure pet by id
     *
     * @param int $petId
     * @return int
     */
    public function curePet($petId)
    {
        $pet = $this->getPet($petId);
        $data = ['star' => $pet['star'] - 1, 'sick' => 0];
        if ($pet['full'] < 2) {
            $data['full'] = 2;
        }
        $this->savePet($petId, $data);
    }

    /**
     * Add food
     *
     * @param int $petId
     * @param int $amount
     * @return int
     */
    public function addFood($petId, $amount)
    {
        $pet = $this->getPet($petId);
        if ($pet['food'] + $amount < 0) {
            $amount = 0;
        } else {
            $amount += $pet['food'];
        }
        $this->savePet($petId, ['food' => $amount]);
    }

    /**
     * Save pet
     *
     * @param int $petId
     * @param array $data
     */
    public function savePet($petId, $data)
    {
        $this->getDB()->update('pet', $data, ['id' => $petId]);
    }

    /**
     * Check and modify pet's status
     *
     * @param int $petId
     */
    public function checkPet($petId)
    {
        $pet = $this->getPet($petId);
        $gameTime = $this->getUtilityService()->getGameTime(Constants::CONFIG_GAME_TIME_TYPE_INT);

        $data = array();
        if (strtotime($pet['last_feed']) + Constants::CONFIG_TIME_FEED <= $gameTime) {
            $reduceFull = floor(($gameTime - strtotime($pet['last_feed'])) / Constants::CONFIG_TIME_FEED);
            $data['full'] = $pet['full'] - $reduceFull >= 0 ? $pet['full'] - $reduceFull : 0;
            $data['last_feed'] = date("Y-m-d H:i:s", strtotime($pet['last_feed']) + $reduceFull * Constants::CONFIG_TIME_FEED);
        }
        if (strtotime($pet['last_bathe']) + Constants::CONFIG_TIME_BATHE <= $gameTime) {
            $reduceClean = floor(($gameTime - strtotime($pet['last_bathe'])) / Constants::CONFIG_TIME_BATHE);
            $data['clean'] = $pet['clean'] - $reduceClean >= 0 ? $pet['clean'] - $reduceClean : 0;
            $data['last_bathe'] = date("Y-m-d H:i:s", strtotime($pet['last_bathe']) + $reduceClean * Constants::CONFIG_TIME_BATHE);
        }
        if (strtotime($pet['last_online']) + Constants::CONFIG_TIME_ONLINE <= $gameTime) {
            $data['last_online'] = $this->getUtilityService()->getGameTime();
        }
        if (isset($data['full']) && $data['full'] == 0) {
            $data['sick'] = 1;
        }

        if (!empty($data)) {
            $this->savePet($petId, $data);
        }
    }
}
