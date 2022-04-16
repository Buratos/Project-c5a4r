<?php

namespace Database\Seeders;

use App\Models\Car;
use App\Models\Color;
use Illuminate\Database\Seeder;

class ColorSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        Color::factory()->count(14)->create();
        Car::lazy()->each(function ($car) {
            $car->color_id = Color::lazy()->random()->id;
            $car->save();
        });
    }
}
