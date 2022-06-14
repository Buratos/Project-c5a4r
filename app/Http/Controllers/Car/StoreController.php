<?php

namespace App\Http\Controllers\Car;

use App\Http\Controllers\BaseController;
use App\Http\Requests\Car\StoreRequest;
use App\Models\BodyType;
use App\Models\Brand;
use App\Models\Car;
use App\Models\Testtable;
use Faker\Factory;

/*********************************************************************
 * записывает новую машину в БД, вызывается из добавления новой машины при получении данных через post
 */
class StoreController extends BaseController {

   public function __invoke(StoreRequest $request) {
      $data = $request->validated();

      $car_title = $this->service->store($data);

      return ["success" => 1, "html" => view("crud.new_car_saved", ["car_title" => $car_title])->render()];
   }
}
