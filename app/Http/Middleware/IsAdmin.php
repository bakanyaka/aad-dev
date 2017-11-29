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
        $admins = ['bds47049','ksa47079','gpa47070','kdi47090','kvv47092','knn47999','pvk47071','maa45066','mkb47091','ino47016'];
        if (in_array($request->user()->username, $admins)) {
            return $next($request);
        }
        return response('Unauthorized.', 401);
    }
}
