<?php

namespace App\Http\Controllers\Car;

use App\Http\Controllers\BaseController;
use App\Jobs\TestJob;
use App\Models\BodyType;
use App\Models\Brand;
use App\Models\Car;
use App\Models\Testtable;
use Faker\Factory;

/*********************************************************************
 * вызывается для выдачи корневой страницы
 */
class IndexController extends BaseController {

   public function __invoke() {
      TestJob::dispatch("function index __ ЗАДАНИЕ ВЫПОЛНЯЕТСЯ из ОЧЕРЕДИ");

      $cars_per_page = 15;

      $cars = Car::inRandomOrder()->Paginate($cars_per_page);
      $cars_number = Car::count();
      $filters = Car::get_filters();
      return view("main_page._carcass_", ["cars" => $cars, "filters" => $filters["filters"], "total_cars_found" => $filters["total_cars_found"], "cars_per_page" => $cars_per_page, "cars_number" => $cars_number, "brands" => Brand::pluck("title")->toArray()]);
   }
}
