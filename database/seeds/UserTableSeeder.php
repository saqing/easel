<?php

namespace Canvas;

use Canvas\Models\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    public function run()
    {
        factory(User::class, 2)->create();
    }
}
