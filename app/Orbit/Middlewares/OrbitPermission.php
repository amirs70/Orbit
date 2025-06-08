<?php

namespace App\Orbit\Middlewares;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OrbitPermission
{
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        /*if (!auth()->check()) {
            return redirect(url(AdminAreaRoute::getPrefix() . "/Login") . "?back=" . urlencode($request->fullUrl()));
        }*/
        return $next($request);
    }
}
