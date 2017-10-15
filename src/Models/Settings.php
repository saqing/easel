<?php

namespace Canvas\Models;

use Schema;
use Canvas\Helpers\CanvasHelper;
use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'canvas_settings';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'setting_name', 'setting_value'];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Get the value of the Blog Title.
     *
     * return @string
     */
    public static function blogTitle()
    {
        return static::getByName('blog_title');
    }

    /**
     * Get the value of the Blog Subtitle.
     *
     * return @string
     */
    public static function blogSubTitle()
    {
        return static::getByName('blog_subtitle');
    }

    /**
     * Get the value of the Blog Description.
     *
     * return @string
     */
    public static function blogDescription()
    {
        return static::getByName('blog_description');
    }

    /**
     * Get the value of the Blog SEO.
     *
     * return @string
     */
    public static function blogSeo()
    {
        return static::getByName('blog_seo');
    }

    /**
     * Get the value of the Blog SEO.
     *
     * return @string
     */
    public static function blogAuthor()
    {
        return static::getByName('blog_author');
    }

    /**
     * Get the current Canvas application version.
     *
     * return @string
     */
    public static function canvasVersion()
    {
        return static::getByName('canvas_version');
    }

    /**
     * Get the value of installed.
     *
     * With a fresh install of Canvas, the Settings table won't be
     * created yet and we can't query it for its installed status.
     * A quick check here allows the user to see the Welcome
     * screen to finish up the installation.
     *
     * return @string
     */
    public static function installed()
    {
        if (! Schema::hasTable(CanvasHelper::TABLES['settings'])) {
            return false;
        } else {
            return static::getByName('installed');
        }
    }

    /**
     * Get the latest release of Canvas.
     *
     * return @string
     */
    public static function latestRelease()
    {
        return static::getByName('latest_release');
    }

    /**
     * Get the value of the Disqus shortname.
     *
     * return @string
     */
    public static function disqus()
    {
        return static::getByName('disqus_name');
    }

    /**
     * Get the value of the ChangYan AppID.
     *
     * return @string
     */
    public static function changyanAppId()
    {
        return static::getByName('changyan_appid');
    }

    /**
     * Get the value of the ChangYan Conf.
     *
     * return @string
     */
    public static function changyanConf()
    {
        return static::getByName('changyan_conf');
    }

    /**
     * Get the value of the Google Analytics Tracking ID.
     *
     * return @string
     */
    public static function gaId()
    {
        return static::getByName('ga_id');
    }

    /**
     * Get the value settings by name.
     *
     * @param  string $settingName Name of setting
     * @param  string $fallback Fallback if the setting does not exist
     * @return string
     */
    public static function getByName($settingName, $fallback = null)
    {
        $setting = static::where('setting_name', $settingName)->first();

        if ($setting === null) {
            return $fallback;
        }

        return $setting->setting_value;
    }

    /**
     * Return the Twitter card type selected by the user.
     *
     * May be either of 'summary', 'summary_large_image' or 'none'
     *
     * return @string
     */
    public static function twitterCardType()
    {
        return static::getByName('twitter_card_type');
    }

    /**
     * Return the custom CSS styles entered by the user.
     *
     * return @string
     */
    public static function customCSS()
    {
        return static::getByName('custom_css');
    }

    /**
     * Return the custom JS scripts entered by the user.
     *
     * return @string
     */
    public static function customJS()
    {
        return static::getByName('custom_js');
    }

    /**
     * Return the user ID of the user whose social icons
     * will be used in the header of the blog.
     *
     * return @int
     */
    public static function socialHeaderIconsUserId()
    {
        return static::getByName('social_header_icons_user_id');
    }
}
