<?php

use App\Orbit\core\Orbit;

function orbit_public(string $url): string
{
    return url("Orbit/public/{$url}");
}

function orbit_asset(string $url): string
{
    return url("Orbit/public/assets/{$url}");
}

function is_dark(): bool
{
    return Cookie::get(Orbit::IS_DARK_NAME, 0) === "1";
    //return request()->cookie(Orbit::IS_DARK_NAME, 0) === 1;
}
