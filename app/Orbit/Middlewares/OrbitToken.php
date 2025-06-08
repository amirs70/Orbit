<?php

namespace App\Orbit\Middlewares;

use App\Orbit\core\Orbit;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class OrbitToken
{

    public function handle(Request $request, Closure $next): Response
    {
        Session::start();
        $cookie = $request->cookie(Orbit::TOKEN_KEY_NAME);
        if (!is_null($cookie)) {
            session()->put(Orbit::TOKEN_KEY_NAME, $cookie);
            return $next($request);
        }
        $token = Orbit::createToken();
        session()->put(Orbit::TOKEN_KEY_NAME, $token);
        return $next($request)
            ->withCookie(cookie(Orbit::TOKEN_KEY_NAME, $token, 60 * 24 * 365, null, null, true));
    }
}
