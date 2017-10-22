<?php

namespace Canvas;

use Canvas\Models\Post;
use Illuminate\Database\Seeder;

class PostTagTableSeeder extends Seeder
{
    public function run()
    {
        Post::all()->each(function ($post) {
            $post->tags()->sync([1]);
        });
    }
}
