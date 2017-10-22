<?php

$factory->define(Canvas\Models\Post::class, function () {
    return [
        'title'             => 'Hello World',
        'slug'              => 'hello-world',
        'subtitle'          => 'Canvas is a simple, powerful blog publishing platform that lets you to share your stories with the world. Its beautifully designed interface allows you to create and publish your own blog, giving you tools that make it easy and even fun to do.',
        'page_image'        => '/vendor/canvas/assets/images/mocha.jpg',
        'content_raw'       => view('canvas::frontend.blog.partials.welcome'),
        'published_at'      => Carbon\Carbon::now(),
        'meta_description'  => 'Let\'s get you up and running with Canvas!',
        'is_published'      => true,
        'layout'            => config('blog.post_layout'),
    ];
});
