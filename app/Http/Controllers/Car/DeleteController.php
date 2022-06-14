<?php

namespace App\Http\Controllers\Car;

use App\Http\Controllers\BaseController;
use App\Models\BodyType;
use App\Models\Brand;
use App\Models\Car;
use App\Models\Testtable;

/*********************************************************************
 * удаление записи / машины / row
 */
class DeleteController extends BaseController {

   public function __invoke() {
//      $this->authorize()
      $car_title = Car::delete_car(request());
      $response = ["delete_car" => 1, "message" => "Car " . $car_title . " deleted."];

      return view("main_page._carcass_", $response);
   }
}
