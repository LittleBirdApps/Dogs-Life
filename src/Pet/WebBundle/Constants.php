<?php

/**
 * This file is part of the Pet.
 *
 * (c) Max Meiden Dasuki <max@littlelives.com>
 */

namespace Pet\WebBundle;

class Constants {
    const ACTION_SUCCESS = 1;
    const ACTION_FAILED = 0;
    const ACTION_ERROR = -1;

    const FLASH_SUCCESS = 'success';
    const FLASH_FAILED = 'warning';
    const FLASH_ERROR = 'danger';

    const CONFIG_INITIAL_PET_ID = 1;

    const CONFIG_GAME_TIME_TYPE_STRING = 0;
    const CONFIG_GAME_TIME_TYPE_INT = 1;
    const CONFIG_MAX_CLEAN = 5;
    const CONFIG_MAX_FULL = 5;
    const CONFIG_SICK_YES = 1;
    const CONFIG_SICK_NO = 0;
    const CONFIG_TIME_BATHE = 28800; //8 hours
    const CONFIG_TIME_FEED = 21600; //6 hours
    const CONFIG_TIME_ONLINE = 300; //5 minutes

}
