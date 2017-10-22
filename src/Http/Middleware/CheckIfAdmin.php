<?php

namespace Canvas\Http\Middleware;

use Auth;
use Closure;
use Canvas\Models\User;

class CheckIfAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = 'canvas')
    {
        if (! User::isAdmin(Auth::guard($guard)->user()->role)) {
            return redirect()->route('canvas.admin');
        }

        return $next($request);
    }
}
