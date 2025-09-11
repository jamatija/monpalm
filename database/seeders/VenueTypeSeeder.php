<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class VenueTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\VenueType::factory()->count(30)->create();
    }
}
