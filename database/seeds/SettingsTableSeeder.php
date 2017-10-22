<?php

namespace Canvas;

use Canvas\Models\Settings;
use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    public function run()
    {
        $settings = new Settings();
        $settings->setting_name = 'blog_author';
        $settings->setting_value = 'John Doe';
        $settings->save();

        $settings = new Settings();
        $settings->setting_name = 'blog_title';
        $settings->setting_value = 'John Doe Blog Title';
        $settings->save();

        $settings = new Settings();
        $settings->setting_name = 'blog_subtitle';
        $settings->setting_value = 'John Doe Blog Subtitle';
        $settings->save();

        $settings = new Settings();
        $settings->setting_name = 'blog_description';
        $settings->setting_value = 'John Doe Blog Description';
        $settings->save();

        $settings = new Settings();
        $settings->setting_name = 'blog_seo';
        $settings->setting_value = 'john,doe,blog,seo';
        $settings->save();

        $settings = new Settings();
        $settings->setting_name = 'disqus_name';
        $settings->setting_value = 'johndoe';
        $settings->save();

        $settings = new Settings();
        $settings->setting_name = 'blog_title';
        $settings->setting_value = 'John Doe Blog';
        $settings->save();

        $settings = new Settings();
        $settings->setting_name = 'ga_id';
        $settings->setting_value = 'johndoe12345';
        $settings->save();

        $settings = new Settings();
        $settings->setting_name = 'twitter_card_type';
        $settings->setting_value = 'none';
        $settings->save();

        $settings = new Settings();
        $settings->setting_name = 'canvas_version';
        $settings->setting_value = 'v0.0.0';
        $settings->save();

        $settings = new Settings();
        $settings->setting_name = 'installed';
        $settings->setting_value = '1484744531';
        $settings->save();
    }
}
