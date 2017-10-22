<?php

namespace Canvas;

use Illuminate\Database\Seeder;

class TestDatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call(PostTableSeeder::class);
        $this->call(TagTableSeeder::class);
        $this->call(PostTagTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(SettingsTableSeeder::class);
    }
}
