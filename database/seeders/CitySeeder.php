<?php

namespace Database\Seeders;

use App\Models\City;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Faker\Provider\ru_Ru\Address as AddressProvider;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();
        $faker->addProvider(new AddressProvider($faker));
        
        for ($i = 0; $i < 10; $i++) {
            do {
                $name = $faker->city();
                $slug = Str::slug($name);
            } while(City::where('name', $name)->exists());

            City::create(compact('name', 'slug'));
        }
    }
}
