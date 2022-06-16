<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         \App\Models\User::factory(10)->create();
         \App\Models\Competition::factory(1)->create();
         \App\Models\Event::factory(1)->create();
         \App\Models\Official::factory(1)->create();
         \App\Models\Program::factory(1)->create();
         \App\Models\Block::factory(10)->create();
    }
}
