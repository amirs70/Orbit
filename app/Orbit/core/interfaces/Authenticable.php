<?php

namespace App\Orbit\core\interfaces;

interface Authenticable
{

    /**
     * @param int $family_id
     * @param string $package The platform the user authenticate from
     * @return string|bool The hash that has been created after successful authentication or false if wasn't successful
     */
    public function auth(int $family_id, string $package = "web"): string|bool;
}
