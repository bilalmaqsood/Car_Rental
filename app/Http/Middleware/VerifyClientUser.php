<?php

namespace Qwikkar\Http\Middleware;

use Closure;

class VerifyClientUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!$request->user()->isClient())
            return api_response('Unauthenticated.', 401);

        return $next($request);
    }
}
