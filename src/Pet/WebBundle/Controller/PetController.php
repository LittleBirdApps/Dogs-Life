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

        $status['max_full'] = Constants::CONFIG_MAX_FULL;
        $status['max_clean'] = Constants::CONFIG_MAX_CLEAN;

        if ($pet['full'] == Constants::CONFIG_MAX_FULL && $pet['clean'] == Constants::CONFIG_MAX_CLEAN) {
            $status['message'] = "Thank you for taking a good care of me!";
        } else if ($pet['full'] <= 1) {
            $status['message'] = "I'm hungry, let's eat :(";
        } else if ($pet['clean'] <= 1) {
            $status['message'] = "I feel itchy, let's take a bath :(";
        } else if ($pet['full'] <= 3) {
            $status['message'] = "I can have some food :|";
        } else if ($pet['clean'] <= 3) {
            $status['message'] = "It's good to clean ourselves up :|";
        } else if ($pet['full'] == Constants::CONFIG_MAX_FULL) {
            $status['message'] = "Thank you for feeding me well :)";
        } else if ($pet['clean'] == Constants::CONFIG_MAX_CLEAN) {
            $status['message'] = "Thank you for cleaning me well :)";
        } else { // full & clean = 4
            $status['message'] = "Life is beautiful!";
        }

        if (empty($this->app['session']->getFlashBag()->peekAll())) {
            $this->setFlash('info', $status['message']);
        }

        return $this->renderTemplate('Pet/home.twig', ['pet' => $pet, 'status' => $status]);
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
            $message = "You don't have enough food :(";
        } else if ($pet['full'] >= Constants::CONFIG_MAX_FULL) {
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

    public function batheAction()
    {
        $petId = Constants::CONFIG_INITIAL_PET_ID;
        $pet = $this->getPetService()->getPet($petId);
        if (empty($pet)) {
            $code = Constants::FLASH_ERROR;
            $message = "Pet is not found!!!";
        } else if ($pet['clean'] >= Constants::CONFIG_MAX_CLEAN) {
            $code = Constants::FLASH_FAILED;
            $message = "I'm already clean! :|";
        } else {
            $this->getPetService()->bathePet($petId);
            $code = Constants::FLASH_SUCCESS;
            $message = "Thanks! I'm as smooth as silk! :)";
        }

        $this->setFlash($code, $message);
        return $this->app->redirect($this->generateUrl('home'));
    }
}
