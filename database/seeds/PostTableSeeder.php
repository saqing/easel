<?php

namespace Canvas;

use Canvas\Models\Post;
use Illuminate\Database\Seeder;

class PostTableSeeder extends Seeder
{
    public function run()
    {
        factory(Post::class, 1)->create();
    }
}
