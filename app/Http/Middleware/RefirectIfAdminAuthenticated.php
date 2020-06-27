<?php

namespace App\Http\Middleware;

use Closure;

class RefirectIfAdminAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (auth()->guard($guard)->check()) {

            return redirect(aurl());
        }

        return $next($request);
    }
}
