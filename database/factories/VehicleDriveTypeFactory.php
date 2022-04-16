<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class VehicleDriveTypeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    static $offset = 0;

    public function definition() {
        $types = ["All wheel drive","Front-wheel drive","Rear drive"];
        if (self::$offset == count($types)) $ret = ["title" => ""];
        else $ret = ["title" => $types[self::$offset]];
        self::$offset++;

        return $ret;
    }
}
