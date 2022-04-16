<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ColorFactory extends Factory {
  /**
   * Define the model's default state.
   *
   * @return array
   */
  static $offset = 0;

  public function definition() {
    $colors = [["White", "#FFFFFF"], ["Light gray", "#D0D0D0"], ["Dark gray", "#858585"], ["Black", "#000000"], ["Blue", "#6694FF"], ["Green", "#139915"], ["Pink", "#FFC4C8"], ["Red", "#E92045"], ["Orange", "#FDB165"], ["Light blue", "#69F6FD"], ["Light green", "#9CFDD1"], ["Brown", "#4A2E11"], ["Yellow", "#FFDD00"], ["Purple", "#FF56FC"]];
    if (self::$offset == count($colors)) $ret = ["title" => "", "value" => ""];
    else $ret = ["title" => $colors[self::$offset][0], "value" => $colors[self::$offset][1]];
    self::$offset++;

    return $ret;
  }
}
