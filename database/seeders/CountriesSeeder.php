<?php
use Illuminate\Database\Seeder;
use App\Models\Country;
use Faker\Factory as Faker;

class CountriesSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        foreach (range(1, 5) as $index) {
            Country::create([
                'name' => $faker->country,
            ]);
        }
    }
}
