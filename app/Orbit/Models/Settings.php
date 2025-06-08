<?php

namespace App\Orbit\Models;

use Exception;
use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{

    private static array $instance = [];

    public static function get(string $key, $default = null): string|int|float|bool|null
    {
        try {
            if (!isset(Settings::$instance[$key])) {
                Settings::$instance[$key] = Settings::where("name", "admin_area_prefix")->first(["value"])->value;
            }
        } catch (Exception $exception) {
            Settings::$instance[$key] = $default;
        }
        return Settings::$instance[$key];
    }

}
