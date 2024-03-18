
<?php
use Illuminate\Database\Seeder;
use App\Models\City;
use Faker\Factory as Faker;

class CitiesSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        foreach (range(1, 10) as $index) {
            City::create([
                'country_id' => rand(1, 5), // Assuming you have 5 countries seeded
                'name' => $faker->city,
            ]);
        }
    }
}
