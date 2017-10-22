<?php

namespace Canvas\Http\Middleware;

use Closure;
use Canvas\Helpers\SetupHelper;

class EnsureNotInstalled
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
        if (SetupHelper::isInstalled()) {
            return redirect()->route('canvas.home');
        }

        return $next($request);
    }
}
