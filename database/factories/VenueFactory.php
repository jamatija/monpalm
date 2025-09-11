<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Venue;
use App\Models\Highlight;

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

     public function configure()
    {
        return $this->afterCreating(function (Venue $venue) {
            $highlightIds = Highlight::inRandomOrder()->take(rand(1, 5))->pluck('id');

            if ($highlightIds->isEmpty()) {
                return;
            }

            $primaryId = $highlightIds->random();

            $pivotData = $highlightIds->mapWithKeys(function ($id) use ($primaryId) {
                return [$id => ['is_primary' => $id === $primaryId]];
            })->toArray();

            $venue->highlights()->attach($pivotData);
        });
    }

}
