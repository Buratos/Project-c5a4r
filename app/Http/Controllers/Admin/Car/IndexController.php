<?php

namespace App\Http\Controllers\Admin\Car;

use App\Http\Controllers\BaseController;
use App\Models\Brand;
use App\Models\Car;

class IndexController extends BaseController {
   /**
    * Handle the incoming request.
    *
    * @param \Illuminate\Http\Request $request
    * @return \Illuminate\Http\Response
    */
   public function __invoke() {
//      return view("admin.car.index");

      $cars_per_page = 15;

      $cars = Car::inRandomOrder()->Paginate($cars_per_page);
      $cars_number = Car::count();
      $filters = Car::get_filters();
      return view("admin.car.index", ["cars" => $cars, "filters" => $filters["filters"], "total_cars_found" => $filters["total_cars_found"], "cars_per_page" => $cars_per_page, "cars_number" => $cars_number, "brands" => Brand::pluck("title")->toArray()]);
   }
}
