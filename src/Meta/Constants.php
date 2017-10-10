<?php

namespace Canvas\Meta;

class Constants
{
    /**
     * @constant(ROLE_USER)
     */
    const ROLE_USER = 0;

    /**
     * @constant(ROLE_ADMINISTRATOR)
     */
    const ROLE_ADMINISTRATOR = 1;

    /**
     * @constant(MAINTENANCE_MODE_ENABLED)
     */
    const MAINTENANCE_MODE_ENABLED = 0;

    /**
     * @constant(MAINTENANCE_MODE_DISABLED)
     */
    const MAINTENANCE_MODE_DISABLED = 1;

    /**
     * @constant(CORE_PACKAGE)
     */
    const CORE_PACKAGE = 'cnvs/easel';

    /**
     * @constant(DEFAULT_THEME_NAME)
     */
    const DEFAULT_THEME_NAME = 'Paper';

    /**
     * @constant(DEFAULT_THEME_VERSION)
     */
    const DEFAULT_THEME_VERSION = 'v1.0.5';

    /**
     * @constant(REQUIRED_TABLES)
     */
    const REQUIRED_TABLES = ['migrations'];

    /**
     * @constant(INSTALLED_FILE)
     */
    const INSTALLED_FILE = 'canvas_installed.lock';

    /**
     * @constant(ROUTE_MIDDLEWARE_GENERAL)
     */
    const ROUTE_MIDDLEWARE_GENERAL = ['checkForMaintenanceMode'];

    /**
     * @constant(ROUTE_MIDDLEWARE_INSTALLED)
     */
    const ROUTE_MIDDLEWARE_INSTALLED = ['canvasInstalled'];

    /**
     * @constant(ROUTE_MIDDLEWARE_ADMIN)
     */
    const ROUTE_MIDDLEWARE_ADMIN = ['checkForMaintenanceMode', 'canvasInstalled', 'auth:canvas'];

    /**
     * @constant(ROUTE_MIDDLEWARE_GROUPS_GENERAL)
     */
    const ROUTE_MIDDLEWARE_GROUPS_GENERAL = ['web'];

    /**
     * @constant(ROUTE_DEFAULT_BLOG_MAIN)
     */
    const ROUTE_DEFAULT_BLOG_MAIN = '/';

    /**
     * @constant(ROUTE_DEFAULT_BLOG_PREFIX)
     */
    const ROUTE_DEFAULT_BLOG_PREFIX = 'blog';

    /**
     * @constant(ROUTE_DEFAULT_ADMIN_PREFIX)
     */
    const ROUTE_DEFAULT_ADMIN_PREFIX = 'admin';

    /**
     * @constant(ROUTE_DEFAULT_AUTH_PREFIX)
     */
    const ROUTE_DEFAULT_AUTH_PREFIX = 'auth';

    /**
     * @constant(ROUTE_DEFAULT_PASSWORD_PREFIX)
     */
    const ROUTE_DEFAULT_PASSWORD_PREFIX = 'password';

    /**
     * @constant(INDEXES)
     */
    const INDEXES = [
        'posts' => 'canvas_posts.index',
        'tags' => 'canvas_tags.index',
        'users' => 'canvas_users.index',
    ];

    /**
     * @constant(TABLES)
     */
    const TABLES = [
        'users' => 'canvas_users',
        'posts' => 'canvas_posts',
        'roles' => 'canvas_roles',
        'tags' => 'canvas_tags',
        'post_tag' => 'canvas_post_tag',
        'settings' => 'canvas_settings',
    ];

    /**
     * @constant(REQUIRED_EXTENSIONS)
     */
    const REQUIRED_EXTENSIONS = [
        'PDO',
        'sqlite3',
        'openssl',
        'mbstring',
        'tokenizer',
        'zip',
    ];
}
