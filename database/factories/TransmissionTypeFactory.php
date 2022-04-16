<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TransmissionTypeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    static $offset = 0;

    public function definition() {
        $types = ["Mechanics","Automatic","Variator","Tiptronic","Robot","Reducer"];
        if (self::$offset == count($types)) $ret = ["title" => ""];
        else {
            $ret = ["title" => $types[self::$offset]];
            self::$offset++;
        }

        return $ret;
    }
}
