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
        // \App\Models\User::factory(10)->create();
        \App\Models\Time::factory(200)->create();
        \App\Models\Jogador::factory(2000)->create();
        \App\Models\Campeonato::factory(200)->create();
        \App\Models\Times_campeonato::factory(200)->create();
    }
}
