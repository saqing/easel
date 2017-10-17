<?php

namespace Canvas\Http\Controllers\Backend;

use Session;
use Canvas\Models\Settings;
use Canvas\Helpers\CanvasHelper;
use Canvas\Extensions\ThemeManager;
use Canvas\Http\Controllers\Controller;
use Canvas\Http\Requests\SettingsUpdateRequest;

class SettingsController extends Controller
{
    /**
     * @var ThemeManager
     */
    protected $themeManager = null;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->themeManager = new ThemeManager(resolve('app'), resolve('files'));
    }

    /**
     * Display the settings page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $data = [
            'blogTitle' => Settings::blogTitle(),
            'blogSubtitle' => Settings::blogSubTitle(),
            'blogDescription' => Settings::blogDescription(),
            'blogSeo' => Settings::blogSeo(),
            'blogAuthor' => Settings::blogAuthor(),
            'postIsPublishedDefault' => Settings::postIsPublishedDefault(),
            'disqus' => Settings::disqus(),
            'changyan_appid' => Settings::changyanAppid(),
            'changyan_conf' => Settings::changyanConf(),
            'analytics' => Settings::gaId(),
            'twitterCardType' => Settings::twitterCardType(),
            'themes' => collect($this->themeManager->getThemes()->toArray())->pluck('name', 'id'),
            'default_theme_name' => $this->themeManager->getDefaultThemeName(),
            'active_theme' => $this->themeManager->getActiveTheme(),
            'active_theme_theme' => $this->themeManager->getTheme($this->themeManager->getActiveTheme()) ?: $this->themeManager->getDefaultTheme(),
            'custom_css' => Settings::customCSS(),
            'custom_js' => Settings::customJS(),
            'url' => $_SERVER['HTTP_HOST'],
            'ip' => $_SERVER['REMOTE_ADDR'],
            'timezone' => env('APP_TIMEZONE'),
            'phpVersion' => phpversion(),
            'phpMemoryLimit' => ini_get('memory_limit'),
            'phpTimeLimit' => ini_get('max_execution_time'),
            'dbConnection' => strtoupper(env('DB_CONNECTION', 'mysql')),
            'webServer' => $_SERVER['SERVER_SOFTWARE'],
            'lastIndex' => date('Y-m-d H:i:s', file_exists(storage_path(CanvasHelper::INDEXES['posts'])) ? filemtime(storage_path(CanvasHelper::INDEXES['posts'])) : false),
            'version' => (! empty(Settings::canvasVersion())) ? Settings::canvasVersion() : 'Less than or equal to v2.1.7',
            'curl' => (in_array('curl', get_loaded_extensions()) ? 'Supported' : 'Not Supported'),
            'curlVersion' => (in_array('curl', get_loaded_extensions()) ? curl_version()['libz_version'] : 'Not Supported'),
            'gd' => (in_array('gd', get_loaded_extensions()) ? 'Supported' : 'Not Supported'),
            'pdo' => (in_array('PDO', get_loaded_extensions()) ? 'Installed' : 'Not Installed'),
            'sqlite' => (in_array('sqlite3', get_loaded_extensions()) ? 'Installed' : 'Not Installed'),
            'openssl' => (in_array('openssl', get_loaded_extensions()) ? 'Installed' : 'Not Installed'),
            'mbstring' => (in_array('mbstring', get_loaded_extensions()) ? 'Installed' : 'Not Installed'),
            'tokenizer' => (in_array('tokenizer', get_loaded_extensions()) ? 'Installed' : 'Not Installed'),
            'zip' => (in_array('zip', get_loaded_extensions()) ? 'Installed' : 'Not Installed'),
            'userAgentString' => $_SERVER['HTTP_USER_AGENT'],
            'socialHeaderIconsUserId' => Settings::socialHeaderIconsUserId(),
        ];

        return view('canvas::backend.settings.index', compact('data'));
    }

    /**
     * Store the site configuration options. This is currently accomplished
     * by finding the specific option, deleting it, and then inserting
     * the new option.
     *
     * @param SettingsUpdateRequest $request
     *
     * @return \Illuminate\View\View
     */
    public function store(SettingsUpdateRequest $request)
    {
        $settings = [
            'blog_title',
            'blog_subtitle',
            'blog_description',
            'blog_seo',
            'blog_author',
            'ga_id',
            'twitter_card_type',
            'custom_css',
            'custom_js',
            'social_header_icons_user_id',
            'post_is_published_default',
        ];

        foreach ($settings as $name) {
            $this->saveSettingFromRequest($request, $name);
        }

        if ($request->exists('disqus_name')) {
            $this->saveSettingFromRequest($request, 'disqus_name');
        }

        if ($request->exists('changyan_appid') || $request->exists('changyan_conf')) {
            $this->saveSettingFromRequest($request, 'changyan_appid');
            $this->saveSettingFromRequest($request, 'changyan_conf');
        }

        Session::put('_update-settings', trans('canvas::messages.save_settings_success'));

        // Update the theme
        $this->themeManager->setActiveTheme($request->input('theme'));

        return redirect()->route('canvas.admin.settings');
    }

    /**
     * Creates or updates a given setting.
     *
     * @param  string $name  Setting name
     * @param  string $value Setting value
     * @return void
     */
    protected function saveSetting($name, $value)
    {
        Settings::updateOrCreate(['setting_name' => $name], ['setting_value' => $value]);
    }

    /**
     * Creates or updates a given setting, based in data from the request.
     *
     * @param  SettingsUpdateRequest $request Request object
     * @param  string                $name    Setting name
     * @return void
     */
    protected function saveSettingFromRequest(SettingsUpdateRequest $request, $name)
    {
        $this->saveSetting($name, $request->input($name));
    }
}
