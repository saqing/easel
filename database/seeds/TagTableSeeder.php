<?php

namespace Canvas;

use Canvas\Models\Tag;
use Illuminate\Database\Seeder;

class TagTableSeeder extends Seeder
{
    public function run()
    {
        factory(Tag::class, 1)->create();
    }
}
