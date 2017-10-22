<?php

namespace Canvas\Helpers;

class RouteHelper extends CanvasHelper
{
    /**
     * Get General Middleware.
     */
    public static function getGeneralMiddleware()
    {
        $config = ConfigHelper::getWriter();
        $val = $config->get('route_middleware_general');

        return is_null($val) ? self::ROUTE_MIDDLEWARE_GROUPS_GENERAL : $val;
    }

    /**
     * Get Safe Middleware.
     */
    public static function getInstalledMiddleware()
    {
        $config = ConfigHelper::getWriter();
        $val = $config->get('route_middleware_installed');

        return is_null($val) ? self::ROUTE_MIDDLEWARE_INSTALLED : $val;
    }

    /**
     * Get Admin Middleware.
     */
    public static function getAdminMiddleware()
    {
        $config = ConfigHelper::getWriter();
        $val = $config->get('route_middleware_admin');

        return is_null($val) ? self::ROUTE_MIDDLEWARE_ADMIN : $val;
    }

    /**
     * Get General Middleware Groups.
     */
    public static function getGeneralMiddlewareGroups()
    {
        $config = ConfigHelper::getWriter();
        $val = $config->get('route_middleware_groups_general');

        return is_null($val) ? self::ROUTE_MIDDLEWARE_GROUPS_GENERAL : $val;
    }

    /**
     * Get blog main path.
     */
    public static function getBlogMain()
    {
        $config = ConfigHelper::getWriter();
        $val = $config->get('blog_path');

        return is_null($val) ? self::ROUTE_DEFAULT_BLOG_MAIN : $val;
    }

    /**
     * Get blog prefix.
     */
    public static function getBlogPrefix()
    {
        $config = ConfigHelper::getWriter();
        $val = $config->get('blog_prefix');

        return is_null($val) ? self::ROUTE_DEFAULT_BLOG_PREFIX : $val;
    }

    /**
     * Get admin prefix.
     */
    public static function getAdminPrefix()
    {
        $config = ConfigHelper::getWriter();
        $val = $config->get('admin_prefix');

        return is_null($val) ? self::ROUTE_DEFAULT_ADMIN_PREFIX : $val;
    }

    /**
     * Get auth prefix.
     */
    public static function getAuthPrefix()
    {
        $config = ConfigHelper::getWriter();
        $val = $config->get('auth_prefix');

        return is_null($val) ? self::ROUTE_DEFAULT_AUTH_PREFIX : $val;
    }

    /**
     * Get password prefix.
     */
    public static function getPasswordPrefix()
    {
        $config = ConfigHelper::getWriter();
        $val = $config->get('password_prefix');

        return is_null($val) ? self::ROUTE_DEFAULT_PASSWORD_PREFIX : $val;
    }

    /**
     * Retrieve a route path. Route without server name etc.
     * @param string $routeName
     * @return string Path
     */
    public static function routePath($routeName)
    {
        $request = resolve('request');

        return preg_replace("/https?:\/\/{$request->server->get('SERVER_NAME')}\//", null, route($routeName));
    }
}
