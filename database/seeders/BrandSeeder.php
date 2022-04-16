<?php

namespace Database\Seeders;

use App\Models\Car;
use App\Models\CarModel;
use App\Models\Brand;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        Brand::factory()->count(23)->create();
        $brands = Brand::all();
        foreach (Car::lazy() as $car) {
            $car->brand_id = $brands->random()->id;
            $car->save();
        }

    }
}
