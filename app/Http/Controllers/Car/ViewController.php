<?php

namespace App\Http\Controllers\Car;

use App\Http\Controllers\BaseController;
use App\Models\Car;
use App\Models\Testtable;

/*********************************************************************
 * просмотр записи / машины / row
 */
class ViewController extends BaseController {

   public function __invoke() {
      $response = $this->service->get_one_car_for_view(request());
      return view("main_page._carcass_", $response);
   }
}

