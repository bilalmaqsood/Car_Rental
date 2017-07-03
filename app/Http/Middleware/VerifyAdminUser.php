<?php

namespace Qwikkar\Http\Middleware;

use Closure;

class VerifyAdminUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!$request->user()->isAdmin())
            return api_response('Unauthenticated.', 401);

        return $next($request);
    }
}
