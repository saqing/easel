<?php

namespace Canvas\Helpers;

use ErrorException;
use Canvas\Models\User;
use Canvas\Meta\Constants;
use Canvas\Models\Settings;
use Illuminate\Http\Request;
use Canvas\Extensions\ExtensionManager;
use Illuminate\Support\Facades\Session;

class CanvasHelper extends Constants
{
    /**
     * Return 'checked' if true.
     *
     * @param $value
     * @return string
     */
    public static function checked($value)
    {
        return $value ? 'checked' : '';
    }

    /**
     * Actions to be taken when user is successfully authenticated.
     *
     * @param Request $request
     * @param User $user
     * @return void
     */
    public static function authenticated(Request $request, User $user)
    {
        // Get and record latest version.
        self::getLatestVersion();

        // Set login message.
        Session::put('_login', trans('canvas::messages.login', ['display_name' => $user->display_name]));
    }

    /**
     * Get the latest release of Canvas.
     * Since the GitHub API requires specific headers to be set, TravisCI will error
     * with a 403 Forbidden. As a workaround, we just return a hardcoded
     * string if the APP_ENV is set to testing.
     *
     * @param bool $update If set to true, latest version in DB will be updated.
     * @return string
     */
    public static function getLatestVersion($update = true)
    {
        if (env('APP_ENV') === 'testing') {
            return 'v0.0.0';
        } else {
            $opts = [
                'http' => [
                    'method' => 'GET',
                    'header' => [
                        'User-Agent: PHP',
                    ],
                ],
            ];

            // Error Exception may be thrown if there is a problem fetching data from the Github API.
            try {
                $context = stream_context_create($opts);
                $stream = file_get_contents('https://api.github.com/repos/cnvs/easel/releases/latest', false, $context);
                $release = json_decode($stream);
            } catch (ErrorException $e) {
                $release = (object) ['name' => 'Unknown'];
            }

            // Save to Canvas Settings
            if ($update) {
                $setting = Settings::updateOrCreate(
                    ['setting_name' => 'latest_release'],
                    ['setting_value' => $release->name]
                );
            }

            return $release->name;
        }
    }

    public static function getLatestRelease()
    {
        return self::getLatestVersion();
    }

    /**
     * Get the currently installed version of Canvas.
     *
     * @param bool $update If set to true, latest version in DB will be updated.
     * @return string
     */
    public static function getCurrentVersion($update = true)
    {
        $extMan = new ExtensionManager(resolve('app'), resolve('files'));
        $packageName = self::CORE_PACKAGE;
        $version = 'Unknown';

        // Retrieve framework (Easel) package info.
        $core = $extMan->getExtension(str_replace('/', '-', self::CORE_PACKAGE), ['canvas-framework']);
        $version = $core->getVersion();
        $dist = $core->__get('dist');
        if (substr($version, 0, 4) === 'dev-') {
            $version .= ' '.substr($dist['reference'], 0, 12);
        }

        // Save to Canvas Settings
        if ($update) {
            $setting = Settings::updateOrCreate(
                ['setting_name' => 'canvas_version'],
                ['setting_value' => $version]
            );
        }

        return $version;
    }

    public static function getInstalledVersion()
    {
        return self::getCurrentVersion();
    }

    public static function getCurrentRelease()
    {
        return self::getCurrentVersion();
    }
}
