<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class EngineTypeFactory extends Factory {
    /**
     * Define the model's default state.
     *
     * @return array
     */
    static $offset = 0;

    public function definition() {
        $types = ["Petrol", "Diesel", "Hybrid", "Electric","Gas"];
        if (self::$offset == count($types)) $ret = ["title" => ""];
        else $ret = ["title" => $types[self::$offset]];
        self::$offset++;

        return $ret;
    }
}
