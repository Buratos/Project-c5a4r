<?php

namespace App\Http\Controllers\Car;

use App\Http\Controllers\BaseController;
use App\Models\BodyType;
use App\Models\Brand;
use App\Models\Car;
use App\Models\Testtable;
use Faker\Factory;

/*
   Displays search results
*/
class SearchController extends BaseController {

   public function __invoke() {

      $cars = Car::get_search_results(request());
      if (!$cars["cars"]->count()) return view("main_page._carcass_", ["error_message" => "No cars found"]);
      return view("main_page._carcass_", ["show_search_results" => 1, "cars" => $cars["cars"], "cars_per_page" => 15, "cars_number" => $cars["cars_number"]]);
   }
}
