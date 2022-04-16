<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BodyTypeFactory extends Factory {
    /**
     * Define the model's default state.
     *
     * @return array
     */
    static $offset = 0;

    public function definition() {
        $typesRUS = ["Седан", "Хэтчбек", "Лифтбек", "Купе", "Универсал", "Пикап", "Кроссовер", "Внедорожник", "Кабриолет", "Родстер", "Фургон", "Минивэн"];
        $types = ["Sedan", "Hatchback", "Liftback", "Coupe", "Universal", "Pickup", "SUV", "Allroad", "Cabrio", "Roadster", "Van", "Minivan"];
        if (self::$offset == count($types)) $ret = ["title" => ""];
        else $ret = ["title" => $types[self::$offset]];
        self::$offset++;

        return $ret;
    }
}
