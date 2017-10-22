<?php

namespace Canvas\Console\Commands;

use File;
use Artisan;
use Exception;
use Canvas\Models\User;
use Canvas\Models\Settings;
use Illuminate\Console\Command;
use Canvas\Helpers\CanvasHelper;

class CanvasCommand extends Command
{
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    protected function title($blogTitle)
    {
        $settings = new Settings();
        $settings->setting_name = 'blog_title';
        $settings->setting_value = $blogTitle;
        $settings->save();
    }

    protected function subtitle($blogSubtitle)
    {
        $settings = new Settings();
        $settings->setting_name = 'blog_subtitle';
        $settings->setting_value = $blogSubtitle;
        $settings->save();
    }

    protected function description($blogDescription)
    {
        $settings = new Settings();
        $settings->setting_name = 'blog_description';
        $settings->setting_value = $blogDescription;
        $settings->save();
    }

    protected function seo($blogSeo)
    {
        $settings = new Settings();
        $settings->setting_name = 'blog_seo';
        $settings->setting_value = $blogSeo;
        $settings->save();
    }

    protected function postsPerPage($postsPerPage, $config)
    {
        $config->set('posts_per_page', intval($postsPerPage));
    }

    protected function disqus()
    {
        $settings = new Settings();
        $settings->setting_name = 'disqus_name';
        $settings->setting_value = null;
        $settings->save();
    }

    protected function changyanAppID()
    {
        $settings = new Settings();
        $settings->setting_name = 'changyan_appid';
        $settings->setting_value = null;
        $settings->save();
    }

    protected function changyanConf()
    {
        $settings = new Settings();
        $settings->setting_name = 'changyan_conf';
        $settings->setting_value = null;
        $settings->save();
    }

    protected function googleAnalytics()
    {
        $settings = new Settings();
        $settings->setting_name = 'ga_id';
        $settings->setting_value = null;
        $settings->save();
    }

    protected function twitterCardType()
    {
        $settings = new Settings();
        $settings->setting_name = 'twitter_card_type';
        $settings->setting_value = 'none';
        $settings->save();
    }

    protected function socialHeaderIcons()
    {
        $settings = new Settings();
        $settings->setting_name = 'social_header_icons_user_id';
        $settings->setting_value = 1;
        $settings->save();
    }

    protected function installed()
    {
        $settings = new Settings();
        $settings->setting_name = 'installed';
        $settings->setting_value = time();
        $settings->save();

        // Write installed lock file.
        File::put(storage_path(CanvasHelper::INSTALLED_FILE), $settings->setting_value);
    }

    protected function uninstalled()
    {
        // Remove installed lock file.
        try {
            File::delete(storage_path(CanvasHelper::INSTALLED_FILE));
        } catch (Exception $e) {
            $this->line(PHP_EOL.'Could not delete install file. Try deleting '
                .storage_path(CanvasHelper::INSTALLED_FILE).' manually.');
            $this->line("<error>✘</error> {$e->getMessage()}");
        }
    }

    /**
     * Save to Settings and return currently installed version.
     *
     * @return string
     */
    protected function canvasVersion()
    {
        return CanvasHelper::getCurrentVersion();
    }

    /**
     * Save to Settings and return latest available version on GitHub.
     *
     * @return string
     */
    protected function latestVersion()
    {
        return CanvasHelper::getLatestVersion();
    }

    protected function packageName()
    {
        return CanvasHelper::CORE_PACKAGE;
    }

    protected function createUser($email, $password, $firstName, $lastName)
    {
        $user = User::firstOrNew(['email' => $email]);
        $user->password = bcrypt($password);
        $user->first_name = $firstName;
        $user->last_name = $lastName;
        $user->display_name = $firstName.' '.$lastName;
        $user->role = CanvasHelper::ROLE_ADMINISTRATOR;
        $user->save();

        $this->author($user->display_name);
    }

    protected function author($blogAuthor)
    {
        $settings = new Settings();
        $settings->setting_name = 'blog_author';
        $settings->setting_value = $blogAuthor;
        $settings->save();
    }

    protected function rebuildSearchIndexes()
    {
        // Remove existing index files, could possibly throw an exception
        try {
            if (file_exists(storage_path(CanvasHelper::INDEXES['posts']))) {
                unlink(storage_path(CanvasHelper::INDEXES['posts']));
            }
            if (file_exists(storage_path(CanvasHelper::INDEXES['users']))) {
                unlink(storage_path(CanvasHelper::INDEXES['users']));
            }
            if (file_exists(storage_path(CanvasHelper::INDEXES['tags']))) {
                unlink(storage_path(CanvasHelper::INDEXES['tags']));
            }
        } catch (Exception $e) {
            $this->line(PHP_EOL.'<error>[✘]</error> '.$e->getMessage());
        }

        // Build the new indexes...
        $exitCode = Artisan::call('canvas:index');
    }
}
