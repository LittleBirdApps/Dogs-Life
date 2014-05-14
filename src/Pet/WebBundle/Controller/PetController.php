<?php

/**
 * This file is part of the Pet.
 *
 * (c) Max Meiden Dasuki <max@littlelives.com>
 */

namespace Pet\WebBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Pet\WebBundle\Constants;

/**
 * Class PetController
 * @package Pet\WebBundle\Controller
 */
class PetController extends BaseController
{
    public function homeAction()
    {
        $petId = Constants::CONFIG_INITIAL_PET_ID;
        $pet = $this->getPetService()->getPet($petId);

        $status['food'] = $pet['food'];
        $status['hunger'] = $pet['hunger'];
        $status['clean'] = $pet['clean'];

        $status['max_hunger'] = Constants::CONFIG_MAX_HUNGER;
        $status['max_clean'] = Constants::CONFIG_MAX_CLEAN;

        return $this->renderTemplate('Pet/home.twig', ['status' => $status]);
    }

    public function feedAction()
    {
        $petId = Constants::CONFIG_INITIAL_PET_ID;
        $pet = $this->getPetService()->getPet($petId);
        if (empty($pet)) {
            $code = Constants::FLASH_ERROR;
            $message = "Pet is not found!!!";
        } else if ($pet['food'] <= 0) {
            $code = Constants::FLASH_FAILED;
            $message = "You don't have enough food :)";
        } else if ($pet['hunger'] >= Constants::CONFIG_MAX_HUNGER) {
            $code = Constants::FLASH_FAILED;
            $message = "Burp! I'm full! :|";
        } else {
            $this->getPetService()->feedPet($petId);
            $code = Constants::FLASH_SUCCESS;
            $message = "Nom... Nom... Nice! Thanks! :)";
        }

        $this->setFlash($code, $message);
        return $this->app->redirect($this->generateUrl('home'));
    }
}
