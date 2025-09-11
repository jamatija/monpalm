<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class VenueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Venue::factory(10)->create();
    }
    
}
