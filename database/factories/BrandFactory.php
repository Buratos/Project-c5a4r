<?php

namespace Database\Factories;

use App\Models\Manufacturer;
use Illuminate\Database\Eloquent\Factories\Factory;

class BrandFactory extends Factory {
    /**
     * Define the model's default state.
     *
     * @return array
     */
    static $offset = 0;

    public function definition() {
        $brands = ["Audi", "BMW", "Opel", "Suzuki", "Peugeot", "Skoda", "Toyota", "Renault", "Kia", "Hyundai", "Fiat", "Cherry", "Ford", "Dodge", "Chrysler", "Mercedes", "Cadillac", "Chevrolet", "Volkswagen", "Nissan", "Honda", "Mitsubishi", "Mazda"];


        if (self::$offset == count($brands)) $ret = ["title" => "offset = " . self::$offset];
        else {
            $ret = ["title" => $brands[self::$offset]];
            self::$offset++;
        }
        return $ret;
    }
}
