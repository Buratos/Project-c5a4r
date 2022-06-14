<?php

namespace App\Http\Controllers\Car;

use App\Http\Controllers\BaseController;
use App\Http\Requests\Car\UpdateRequest;
use App\Models\Testtable;

/*********************************************************************
 * редактирование записи / машины / row
 */
class UpdateController extends BaseController {

   public function __invoke(UpdateRequest $request) {

      $data = $request->validated();

      $car_title = $this->service->update($data);

      return ["success" => 1, "html" => view("crud.car_updated", ["car_title" => $car_title])->render()];
   }
}
