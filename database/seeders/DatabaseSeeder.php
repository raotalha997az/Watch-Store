<?php

namespace Database\Seeders;

use App\Models\AreaLandmark;
use App\Models\City;
use App\Models\Country;
use App\Models\Store;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

            Store::factory(10)->create();

            Store::factory()->create([
                'name' => '',
                'address' => '',
                'contact_person' => '',
            ]);


            Country::factory(10)->create();
            Country::factory()->create([
                'name' => '',
            ]);

            // City::factory(10)->create();
            // City::factory()->create([
            //     'name' => '',
            //     'name' => '',
            //     'name' => '',
            // ]);

            // AreaLandmark::factory(10)->create();
            // AreaLandmark::factory()->create([
            //     'city_id' => '',
            //     'name' => '',
            //     'coordinates' => '',
            // ]);

    }
}

