<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\HiglightSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(UserSeeder::class);
        $this->call(VenueTypeSeeder::class);
        $this->call(MunicipalitySeeder::class);
        $this->call(HiglightSeeder::class);
        $this->call(VenueSeeder::class); 
    }
}
