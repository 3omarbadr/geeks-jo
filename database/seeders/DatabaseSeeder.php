<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Area;
use App\Models\City;
use App\Models\User;
use App\Models\Country;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        User::truncate();
        Country::truncate();
        City::truncate();
        Area::truncate();
        Schema::enableForeignKeyConstraints();

        User::factory()->create([
            'name' => 'Omar Badr',
            'email' => 'admin@geeks.io',
            'password' => bcrypt('Pa$$w0rd')
        ]);

        Country::factory(20)->create();
        City::factory(100)->create();
        Area::factory(200)->create();
        
    }
}
