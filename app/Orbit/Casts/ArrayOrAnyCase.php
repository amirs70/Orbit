<?php

namespace App\Orbit\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class ArrayOrAnyCase implements CastsAttributes
{
    public function get($model, string $key, $value, array $attributes)
    {
        $json = json_decode($value, true);
        if (is_array($json)) {
            return $json;
        }
        return $value;
    }

    public function set($model, string $key, $value, array $attributes)
    {
        if (is_array($value)) {
            return json_encode($value);
        }
        return $value;
    }
}
