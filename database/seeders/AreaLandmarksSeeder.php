<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class AreaLandmarksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        foreach (range(1, 20) as $index) {
            AreaLandmark::create([
                'city_id' => rand(1, 10), // Assuming you have 10 cities seeded
                'name' => $faker->streetName,
                'coordinates' => $faker->latitude() . ', ' . $faker->longitude(), // Assuming coordinates are latitude and longitude
            ]);
        }
    }
}
