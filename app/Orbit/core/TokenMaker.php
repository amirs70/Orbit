<?php

namespace App\Orbit\core;

use App\Orbit\core\TokenMakers\TokenMakerable;

class TokenMaker
{

    private static TokenMakerable $tokenMaker;

    public static function setMaker(string|TokenMakerable $maker)
    {
        TokenMaker::$tokenMaker = $maker instanceof TokenMakerable ? $maker : new $maker();
    }

    public static function make(): string
    {
        return TokenMaker::$tokenMaker->makeToken();
    }

}
