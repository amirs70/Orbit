<?php

namespace App\Orbit\core\TokenMakers;

use Illuminate\Support\Facades\Hash;

class HashTokenMaker implements TokenMakerable
{

    public function makeToken(): string
    {
        return Hash::make(time());
    }
}
