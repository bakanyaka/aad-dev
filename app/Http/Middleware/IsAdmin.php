<?php

namespace App\Http\Middleware;

use Closure;

class IsAdmin
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
        $admins = ['bds47049'];
        if (env('APP_ENV') === 'testing') {
            return $next($request);
        }
        if (in_array($request->user()->username, $admins)) {
            return $next($request);
        }
        return response('Unauthorized.', 401);
    }
}
