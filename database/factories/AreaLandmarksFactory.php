<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AreaLandmark>
 */
class AreaLandmarksFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'city_id'=> fake()->numberBetween(1,10),
            'name' => fake()->streetAddress(),
            'coordinates' => fake()->latitude() . ', ' . fake()->longitude(),
        ];
    }



}
