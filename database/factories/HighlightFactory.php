<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class HighlightFactory extends Factory
{
    public function definition(): array
    {
        $name = $this->faker->unique()->words(2, true);  
        $slug = Str::slug($name);

        return [
            'name'     => ucfirst($name),
            'slug'     => $slug,
            'category' => $this->faker->randomElement([
                'food',
                'drink',
                'cocktails',
                'music',
                'special'  
            ]),
        ];
    }
}
