<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CarFactory extends Factory {
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition() {
        $engine_capacity = (integer)floor(mt_rand(800, 6500) / 100) * 100;
        $engine_power = (integer)floor($engine_capacity / 11);
        $fuel_consumption_highway = mt_rand(60, 120) / 10;
        $fuel_consumption_city = $fuel_consumption_highway * 1.6;
        $fuel_consumption_mixed = $fuel_consumption_highway * 1.3;
        $model_year = mt_rand(2000, 2021);
        $production_year = mt_rand($model_year, 2022);
        $number_doors = mt_rand(2, 5);
        $number_places = mt_rand(2, 7);
        $description = $this->faker->text(4000);
        $length = mt_rand(3600, 5200);
        $width = (integer)($length / (mt_rand(233, 254) / 100));
        $height = mt_rand(165, 190);
        $price = mt_rand(3000, 80000);
        $mileage = mt_rand(50, 400000);
        $was_in_accident = mt_rand(0, 1);

        return ["engine_capacity" => $engine_capacity, "engine_power" => $engine_power, "fuel_consumption_highway" => $fuel_consumption_highway, "fuel_consumption_city" => $fuel_consumption_city, "fuel_consumption_mixed" => $fuel_consumption_mixed, "model_year" => $model_year, "production_year" => $production_year, "number_doors" => $number_doors, "number_places" => $number_places, "description" => $description, "length" => $length, "width" => $width, "height" => $height, "price" => $price, "mileage" => $mileage, "was_in_accident" => $was_in_accident];
    }
}
