<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductionCountryFactory extends Factory {
    /**
     * Define the model's default state.
     *
     * @return array
     */
    static $offset = 0;

    public function definition() {
        $countriesRUS = ["Китай", "Россия", "США", "Мексика", "Япония", "Корея", "Чехия", "Венгрия", "Англия", "Германия", "Франция", "Италия", "Индия", "Марокко", "Турция", "Бразилия", "Аргентина", "Испания", "Швеция", "ЮАР", "Вьетнам"];
        $countries = ["China", "Russia", "USA", "Mexico", "Japan", "Korea", "Czech", "Hungary", "England", "Germany", "France", "Italy", "India", "Marocco", "Turkey", "Brazilia", "Argentina", "Spain", "Sweden", "South Africa Republic", "Vietnam"];
        if (self::$offset == count($countries)) $ret = ["title" => ""];
        else $ret = ["title" => $countries[self::$offset]];
        self::$offset++;

        return $ret;
    }
}
