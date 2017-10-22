<?php

use Canvas\Helpers\RouteHelper;

/* Frontend page routes. */
Route::group([
    'middlewareGroups' => RouteHelper::getGeneralMiddlewareGroups(),
    'middleware' => RouteHelper::getGeneralMiddleware(),
    'prefix' => RouteHelper::getBlogMain(),
], function () {

    /* Installation page route. */
    Route::get('canvas.install', 'Canvas\Http\Controllers\Setup\InstallController@index')->name('canvas.install');

    /* Fully-installed and configured routes. */
    Route::group([
        'middleware' => RouteHelper::getInstalledMiddleware(),
    ], function () {
        Route::get('/', 'Canvas\Http\Controllers\Frontend\BlogController@index')->name('canvas.home');

        Route::group(['prefix' => RouteHelper::getBlogPrefix()], function () {
            Route::get('/', 'Canvas\Http\Controllers\Frontend\BlogController@index')->name('canvas.blog.post.index');
            Route::get('post/{slug}', 'Canvas\Http\Controllers\Frontend\BlogController@showPost')->name('canvas.blog.post.show');
        });

        /* Authentication routes. */
        Route::group([
            'namespace' => 'Canvas\Http\Controllers\Auth',
        ], function () {
            Route::group([
                'prefix' => RouteHelper::getAuthPrefix(),
            ], function () {
                Route::get('login', 'LoginController@showLoginForm')->name('canvas.login');
                Route::post('login', 'LoginController@login')->name('canvas.auth.login.store');
                Route::get('logout', 'LoginController@logout')->name('canvas.auth.logout');
            });

            /* Reset password routes. */
            Route::group(['prefix' => RouteHelper::getPasswordPrefix()], function () {
                Route::post('/', 'PasswordController@updatePassword')->name('canvas.auth.password.update');
                Route::get('forgot', 'ForgotPasswordController@showLinkRequestForm')->name('canvas.auth.password.forgot');
                Route::post('forgot', 'ForgotPasswordController@sendResetLinkEmail')->name('canvas.auth.password.forgot.store');
                Route::get('reset/{token}', 'ResetPasswordController@showResetForm')->name('canvas.auth.password.reset');
                Route::post('reset', 'ResetPasswordController@reset')->name('canvas.auth.password.reset.store');
            });
        });
    });
});

/* Backend page routes. */
Route::group([
    'middlewareGroups' => RouteHelper::getGeneralMiddlewareGroups(),
    'middleware' => RouteHelper::getAdminMiddleware(),
    'namespace' => 'Canvas\Http\Controllers\Backend',
    'prefix' => RouteHelper::getAdminPrefix(),
], function () {
    /* Admin dashboard page route. */
    Route::get('', 'HomeController@index')->name('canvas.admin');

    /* Post page routes. */
    Route::resource('/post', 'PostController', [
        'except' => 'show',
        'names' => [
            'index' => 'canvas.admin.post.index',
            'create' => 'canvas.admin.post.create',
            'store' => 'canvas.admin.post.store',
            'edit' => 'canvas.admin.post.edit',
            'update' => 'canvas.admin.post.update',
            'destroy' => 'canvas.admin.post.destroy',
        ],
    ]);

    /* Tag page routes. */
    Route::resource('/tag', 'TagController', [
        'except' => 'show',
        'names' => [
            'index' => 'canvas.admin.tag.index',
            'create' => 'canvas.admin.tag.create',
            'store' => 'canvas.admin.tag.store',
            'edit' => 'canvas.admin.tag.edit',
            'update' => 'canvas.admin.tag.update',
            'destroy' => 'canvas.admin.tag.destroy',
        ],
    ]);

    /* Media library page routes. */
    Route::get('/upload', 'UploadController@index')->name('canvas.admin.upload');
    \TalvBansal\MediaManager\Routes\MediaRoutes::get();

    /* Profile privacy page routes. */
    Route::get('/profile/privacy', 'ProfileController@editPrivacy')->name('canvas.admin.profile.privacy');
    Route::resource('/profile', 'ProfileController', [
        'only' => ['index', 'update'],
        'names' => [
            'index' => 'canvas.admin.profile.index',
            'update' => 'canvas.admin.profile.update',
        ],
    ]);

    /* Search page routes. */
    Route::resource('/search', 'SearchController', [
        'only' => ['index'],
        'names' => [
            'index' => 'canvas.admin.search.index',
        ],
    ]);

    /* Help page routes. */
    Route::get('/help', 'HelpController@index')->name('canvas.admin.help');

    /* Admin-only accessible routes. */
    Route::group(['middleware' => 'checkIfAdmin'], function () {
        Route::resource('/user', 'UserController', [
            'except' => 'show',
            'names' => [
                'index' => 'canvas.admin.user.index',
                'create' => 'canvas.admin.user.create',
                'store' => 'canvas.admin.user.store',
                'edit' => 'canvas.admin.user.edit',
                'update' => 'canvas.admin.user.update',
                'destroy' => 'canvas.admin.user.destroy',
            ],
        ]);

        /* User privacy page routes. */
        Route::get('/user/{id}/privacy', 'UserController@privacy')->name('canvas.admin.user.privacy');
        Route::post('/user/{id}/privacy', 'UserController@updatePassword')->name('canvas.admin.user.privacy');

        /* Tools page routes. */
        Route::get('/tools', 'ToolsController@index')->name('canvas.admin.tools');
        Route::post('/tools/reset_index', 'ToolsController@resetIndex')->name('canvas.admin.tools.reset_index');
        Route::post('/tools/cache_clear', 'ToolsController@clearCache')->name('canvas.admin.tools.cache_clear');
        Route::post('/tools/download_archive', 'ToolsController@handleDownload')->name('canvas.admin.tools.download_archive');
        Route::post('/tools/enable_maintenance_mode', 'ToolsController@enableMaintenanceMode')->name('canvas.admin.tools.enable_maintenance_mode');
        Route::post('/tools/disable_maintenance_mode', 'ToolsController@disableMaintenanceMode')->name('canvas.admin.tools.disable_maintenance_mode');

        /* Settings page routes. */
        Route::get('/settings', 'SettingsController@index')->name('canvas.admin.settings');
        Route::post('/settings', 'SettingsController@store')->name('canvas.admin.settings');
    });
});
