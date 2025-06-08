<?php

namespace App\Orbit\core\TokenMakers;

interface TokenMakerable
{
    public function makeToken(): string;
}
