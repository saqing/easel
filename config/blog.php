<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Canvas Configuration : Blog Posts Per Page
    |--------------------------------------------------------------------------
    |
    | Pretty self-explanatory here. Indicate how many posts you would like
    | to appear on each page.
    |
    */
    'posts_per_page' => 6,

    /*
    |--------------------------------------------------------------------------
    | Canvas Configuration : Trim Width
    |--------------------------------------------------------------------------
    |
    | To make sure post subtitles and post excerpts display properly in
    | the application, we need to trim the width of them and simply
    | add an ellipses at the trim point.
    |
    | backend_trim_width: Used in resource/views/backend/tag/index.blade.php
    | frontend_trim_width: Used in resource/views/frontend/blog/partials/posts.blade.php
    |
    */
    'backend_trim_width' => 40,
    'frontend_trim_width' => 225,

    /*
    |--------------------------------------------------------------------------
    | Canvas Configuration : Post Layout
    |--------------------------------------------------------------------------
    |
    | The default layout for creating new posts.
    |
    */
    'post_layout' => 'canvas::frontend.blog.post',

    /*
    |--------------------------------------------------------------------------
    | Canvas Configuration : Tag Layout
    |--------------------------------------------------------------------------
    |
    | Changing the Tag Layout requires an update in the following locations:
    |
    | config/blog.php
    | src/Http/Controllers/Backend/TagController.php
    | src/Models/Tag.php
    |
    */
    'tag_layout' => 'canvas::frontend.blog.index',

    /*
    |--------------------------------------------------------------------------
    | Canvas Configuration : Extensions Enabled
    |--------------------------------------------------------------------------
    |
    | List of enabled extensions.
    |
    */
    'extensions_enabled' => '',

    /*
    |--------------------------------------------------------------------------
    | Canvas Configuration : Blog Path
    |--------------------------------------------------------------------------
    |
    | Main path to blog.
    |
    */
    'blog_path' => '/',

    /*
    |--------------------------------------------------------------------------
    | Canvas Configuration : Blog Prefix
    |--------------------------------------------------------------------------
    |
    | Main prefix for blog.
    |
    */
    'blog_prefix' => 'blog',

    /*
    |--------------------------------------------------------------------------
    | Canvas Configuration : Auth Prefix
    |--------------------------------------------------------------------------
    |
    | Auth prefix for blog.
    |
    */
    'auth_prefix' => 'auth',

    /*
    |--------------------------------------------------------------------------
    | Canvas Configuration : General Middleware
    |--------------------------------------------------------------------------
    |
    | Middleware to apply to every route.
    |
    */
    'route_middleware_general' => ['checkForMaintenanceMode'],

    /*
    |--------------------------------------------------------------------------
    | Canvas Configuration : General Middleware Groups
    |--------------------------------------------------------------------------
    |
    | Middleware groups to apply to every route.
    |
    */
    'route_middleware_groups_general' => ['web'],

    /*
    |--------------------------------------------------------------------------
    | Canvas Configuration : Admin Middleware
    |--------------------------------------------------------------------------
    |
    | Middleware to apply to admin routes.
    |
    */
    'route_middleware_admin' => ['checkForMaintenanceMode', 'canvasInstalled', 'auth:canvas'],
];
