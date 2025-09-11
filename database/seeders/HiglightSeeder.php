<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class HiglightSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Highlight::factory()->count(20)->create();
    }
}
