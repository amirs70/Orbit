<?php

namespace App\Orbit\core\Routes;

use App\Orbit\Middlewares\OrbitAuth;
use App\Orbit\Middlewares\OrbitJsonParser;
use App\Orbit\Middlewares\OrbitToken;
use App\Orbit\Models\Settings;
use Closure;
use Illuminate\Routing\Route as R;
use Illuminate\Routing\RouteRegistrar;
use Illuminate\Support\Facades\Route;
use function request;

class OrbitRoute extends Route
{

    private static array $registeredAjax = [];
    private static ?string $prefix = null;
    private static string $default_prefix = "Orbit";

    public static function getPrefix(): string
    {
        return Settings::get("admin_area_prefix", self::$default_prefix);
    }

    public static function registerAjax($method, $cluster): void
    {
        self::$registeredAjax[$method] = $cluster;
    }

    public function ajax()
    {
        $vars = get_defined_vars();
        $method = request("method", "");
        if (isset(OrbitRoute::$registeredAjax[$method])) {
            $cb = is_array(OrbitRoute::$registeredAjax[$method]) ? [new OrbitRoute::$registeredAjax[$method][0], OrbitRoute::$registeredAjax[$method][1]] : OrbitRoute::$registeredAjax[$method];
            return call_user_func_array($cb, $vars);
        }
        return response()->json(["success" => false, "error" => "Method is not registered."], 401);
    }

    public static function groups(array|string|Closure $routes = [], array $attributes = []): RouteRegistrar
    {
        if (isset($attributes["middleware"])) {
            $attributes["middleware"] = array_merge([OrbitJsonParser::class, OrbitToken::class, OrbitAuth::class, "web"], $attributes["middleware"]);
        } else {
            $attributes["middleware"] = [OrbitJsonParser::class, OrbitToken::class, OrbitAuth::class, "web"];
        }
        return parent::as("orbit.")
            ->prefix(self::getPrefix())
            ->middleware($attributes["middleware"])
            ->group($routes);
    }

    public static function get(string $uri, callable|array|string|null $action = null): R
    {
        return parent::prefix(self::getPrefix())
            ->as("orbit.")
            ->middleware([OrbitToken::class, OrbitAuth::class])
            ->get(($uri[0] === "/" ? "" : "/") . $uri, $action);
    }

    public static function post(string $uri, callable|array|string|null $action = null): R
    {
        return parent::prefix(self::getPrefix())
            ->as("orbit.")
            ->middleware([OrbitToken::class, OrbitAuth::class])
            ->post(($uri[0] === "/" ? "" : "/") . $uri, $action);
    }

    public static function delete(string $uri, callable|array|string|null $action = null): R
    {
        return parent::prefix(self::getPrefix())
            ->as("orbit.")
            ->middleware([OrbitToken::class, OrbitAuth::class])
            ->delete(($uri[0] === "/" ? "" : "/") . $uri, $action);
    }

    public static function put(string $uri, callable|array|string|null $action = null): R
    {
        return parent::prefix(self::getPrefix())
            ->as("orbit.")
            ->middleware([OrbitToken::class, OrbitAuth::class])
            ->put(($uri[0] === "/" ? "" : "/") . $uri, $action);
    }

    public static function patch(string $uri, callable|array|string|null $action = null): R
    {
        return parent::prefix(self::getPrefix())
            ->as("orbit.")
            ->middleware([OrbitToken::class, OrbitAuth::class])
            ->patch(($uri[0] === "/" ? "" : "/") . $uri, $action);
    }

}
