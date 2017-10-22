<?php

namespace Canvas\Http\Middleware;

use Closure;
use Session;
use Illuminate\Routing\Route;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode as Original;

class CheckForMaintenanceMode extends Original
{
    protected $excludedNames = [];

    protected $except = [];

    protected $excludedIPs = [];

    protected function shouldPassThrough($request)
    {
        $admin = preg_replace("/https?:\/\/{$request->server->get('SERVER_NAME')}\//", null, route('canvas.admin'));
        $this->except = [$admin, "$admin/*", 'auth/*'];

        foreach ($this->except as $except) {
            if ($except !== '/') {
                $except = trim($except, '/');
            }

            if ($request->is($except)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @throws \Symfony\Component\HttpKernel\Exception\HttpException
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($this->app->isDownForMaintenance()) {
            $response = $next($request);

            if (in_array($request->ip(), $this->excludedIPs + $this->getExcludedIPs())) {
                return $response;
            }

            $route = $request->route();

            if ($route instanceof Route) {
                if (in_array($route->getName(), $this->excludedNames)) {
                    return $response;
                }
            }

            if ($this->shouldPassThrough($request)) {
                return $response;
            }

            throw new HttpException(503);
        }

        return $next($request);
    }

    public function getExcludedIPs()
    {
        return (array) Session::get('admin_ip', []);
    }
}
