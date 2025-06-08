<?php

namespace App\Orbit\core;

use App\Orbit\core\interfaces\Authenticable;

class Orbit
{

    const TITLE = "Orbit";
    const TOKEN_KEY_NAME = "FBSRF-TOKEN";
    const IS_DARK_NAME = "IS_DARK";

    public static function createToken(): string
    {
        return TokenMaker::make();
    }

    public static function setAuthClass(Authenticable $auth)
    {

    }

}
