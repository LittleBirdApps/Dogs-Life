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
        $this->getPetService()->checkPet($petId);

        $pet = $this->getPetService()->getPet($petId);

        $status['max_full'] = Constants::CONFIG_MAX_FULL;
        $status['max_clean'] = Constants::CONFIG_MAX_CLEAN;

        $gameTime = $this->getUtilityService()->getGameTime(Constants::CONFIG_GAME_TIME_TYPE_INT);
        if (date("G", $gameTime) >= Constants::CONFIG_TIME_SLEEP_START || date("G", $gameTime) < Constants::CONFIG_TIME_SLEEP_END) {
            $status['condition'] = 'sleep';
            $status['message'] = "*zzz*";
        } else if (date("G", $gameTime) == 21) {
            $status['condition'] = 'sleepy';
            $status['message'] = "I'm sleepy. Let's prepare to sleep.";
        } else if ($pet['type_id'] == Constants::CONFIG_PET_TYPE_EGG) {
            $status['condition'] = 'normal';
            $status['message'] = Constants::getEggConversation()[array_rand(Constants::getEggConversation())];
        } else if ($pet['sick'] == Constants::CONFIG_SICK_YES) {
            $status['condition'] = 'sick';
            $status['message'] = "I'm sick :(";
        } else if ($pet['full'] == Constants::CONFIG_MAX_FULL && $pet['clean'] == Constants::CONFIG_MAX_CLEAN) {
            $status['condition'] = 'superb';
            $status['message'] = "I'm in perfect condition! Thanks!";
        } else if ($pet['full'] <= 1 && $pet['clean'] <= 1) {
            $status['condition'] = 'angry';
            $status['message'] = "Please take care of me!";
        } else if ($pet['full'] <= 1) {
            $status['condition'] = 'hungry';
            $status['message'] = "I'm hungry, let's eat :(";
        } else if ($pet['clean'] <= 1) {
            $status['condition'] = 'itchy';
            $status['message'] = "I feel itchy, let's take a bath :(";
        } else if ($pet['full'] <= 3) {
            $status['condition'] = 'normal';
            $status['message'] = "I can have some food :|";
        } else if ($pet['clean'] <= 3) {
            $status['condition'] = 'normal';
            $status['message'] = "It's good to clean ourselves up :|";
        } else {
            $status['condition'] = 'happy';
            $status['message'] = "Life is beautiful!";
        }

        if (empty($this->app['session']->getFlashBag()->peekAll())) {
            $messageType = $pet['sick'] == Constants::CONFIG_SICK_YES ? 'danger' : 'info';
            $this->setFlash($messageType, $status['message']);
        }

        return $this->renderTemplate('Pet/home.twig', ['pet' => $pet, 'status' => $status]);
    }

    public function feedAction()
    {
        $petId = Constants::CONFIG_INITIAL_PET_ID;
        $pet = $this->getPetService()->getPet($petId);

        $gameTime = $this->getUtilityService()->getGameTime(Constants::CONFIG_GAME_TIME_TYPE_INT);
        if (empty($pet)) {
            $code = Constants::FLASH_ERROR;
            $message = "Pet is not found!!!";
        } else if (date("G", $gameTime) >= Constants::CONFIG_TIME_SLEEP_START || date("G", $gameTime) < Constants::CONFIG_TIME_SLEEP_END) {
            $code = Constants::FLASH_FAILED;
            $message = "(I'm sleeping) *zzz*";
        } else if ($pet['type_id'] == Constants::CONFIG_PET_TYPE_EGG) {
            $code = Constants::FLASH_SUCCESS;
            $message = "I don't need to eat yet :)";
        } else if ($pet['food'] <= 0) {
            $code = Constants::FLASH_FAILED;
            $message = "You don't have enough food :(";
        } else if ($pet['full'] >= Constants::CONFIG_MAX_FULL) {
            $code = Constants::FLASH_FAILED;
            $message = "(Burp) I'm full :|";
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

        $gameTime = $this->getUtilityService()->getGameTime(Constants::CONFIG_GAME_TIME_TYPE_INT);
        if (empty($pet)) {
            $code = Constants::FLASH_ERROR;
            $message = "Pet is not found!!!";
        } else if (date("G", $gameTime) >= Constants::CONFIG_TIME_SLEEP_START || date("G", $gameTime) < Constants::CONFIG_TIME_SLEEP_END) {
            $code = Constants::FLASH_FAILED;
            $message = "(I'm sleeping) *zzz*";
        } else if ($pet['type_id'] == Constants::CONFIG_PET_TYPE_EGG) {
            $code = Constants::FLASH_SUCCESS;
            $message = "I don't need to shower yet :)";
        } else if ($pet['clean'] >= Constants::CONFIG_MAX_CLEAN) {
            $code = Constants::FLASH_FAILED;
            $message = "I'm already clean :|";
        } else {
            $this->getPetService()->bathePet($petId);
            $code = Constants::FLASH_SUCCESS;
            $message = "Thanks! I'm as smooth as silk! :)";
        }

        $this->setFlash($code, $message);
        return $this->app->redirect($this->generateUrl('home'));
    }

    public function starAction()
    {
        $petId = Constants::CONFIG_INITIAL_PET_ID;
        $pet = $this->getPetService()->getPet($petId);
        if (empty($pet)) {
            $code = Constants::FLASH_ERROR;
            $message = "Pet is not found!!!";
        } else if ($pet['star'] <= 0) {
            $code = Constants::FLASH_FAILED;
            $message = "You don't have enough star :|";
        } else if ($pet['sick'] == Constants::CONFIG_SICK_NO) {
            $code = Constants::FLASH_FAILED;
            $message = "I'm not sick :|";
        } else {
            $this->getPetService()->curePet($petId);
            $code = Constants::FLASH_SUCCESS;
            $message = "Thanks! I'm healthy again! :)";
        }

        $this->setFlash($code, $message);
        return $this->app->redirect($this->generateUrl('home'));
    }
}
