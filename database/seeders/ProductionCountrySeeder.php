<?php

namespace Database\Seeders;

use App\Models\Car;
use App\Models\ProductionCountry;
use Illuminate\Database\Seeder;

class ProductionCountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProductionCountry::factory()->count(21)->create();

        $countries = ProductionCountry::all()->pluck("id");
        foreach (Car::lazy() as $car) {
            $car->production_country_id = $countries->random();
            $car->save();
        }
    }
}
