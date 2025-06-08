<?php

namespace App\Orbit\Middlewares;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OrbitJsonParser
{

    public function handle(Request $request, Closure $next): Response
    {
        if ($request->isJson() && !empty($request->getContent())) {
            $data = json_decode($request->getContent(), true);
            if (json_last_error() === JSON_ERROR_NONE) {
                $request->merge($data);
            }
        }
        return $next($request);
    }
}
