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
            ->where('id = :pet_id')
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
        $this->getDB()->update('pet', ['food' => $pet['food'] -1, 'hunger' => $pet['hunger'] + 1], ['id' => $petId]);
    }
}
