<?php

namespace Canvas;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call('Canvas\PostTableSeeder');
        $this->call('Canvas\TagTableSeeder');
        $this->call('Canvas\PostTagTableSeeder');
    }
}
