<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Venue>
 */
class VenueFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user = \App\Models\User::first() ?? \App\Models\User::factory()->create();
        $municipality = \App\Models\Municipality::first() ?? \App\Models\Municipality::factory()->create();
        $venue_type = \App\Models\VenueType::first() ?? \App\Models\VenueType::factory()->create();

        return [
            'name' => $this->faker->company(),
            'description' => $this->faker->paragraph(),
            'is_active' => $this->faker->boolean(),
            'google_maps_link' => $this->faker->url(),
            'user_id' => $user->id, 
            'municipality_id' => $municipality->id,
            'type_id' => $venue_type->id,
        ];
    }

}
