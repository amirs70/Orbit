<?php

namespace App\Orbit\Middlewares;

use App\Orbit\core\Auth\FamilyAuth;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OrbitAuth
{

    public function handle(Request $request, Closure $next): Response
    {
        $auth = FamilyAuth::getActiveLogin($request);
        if (!$auth) {
            return redirect(route("orbit.login", ["after" => $request->fullUrl()]));
        }
        $family = $auth->family;
        view()->share("user", $family);
        $request->merge(["auth" => $auth, "family" => $family]);
        return $next($request);
    }
}
