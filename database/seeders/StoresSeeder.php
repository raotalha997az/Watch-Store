<?php
use Illuminate\Database\Seeder;
use App\Models\Store;
use Faker\Factory as Faker;

class StoresSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        foreach (range(1, 10) as $index) {
            Store::create([
                'name' => $faker->company,
                'address' => $faker->address,
                'contact_person' => $faker->name,
            ]);
        }
    }
}
