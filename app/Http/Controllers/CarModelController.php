<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\CarModel;
use Illuminate\Http\Request;

class CarModelController extends Controller {
   /********************************************************************
    * при выборе брэнда подгрузка названий моделей в <input> -> <datalist>
    */
   public function get_car_model_datalist(Request $request) {
      $brand = json_decode($request->data);
      $models_number = Brand::where("title", $brand)->count();
      if (!$models_number) {
         return ["success" => 0, "error_message" => "No models found of the brand you entered"];
      }
      $models = Brand::whereTitle($brand)->first();
      $models = $models->models;

      return ["success" => 1, "html" => view("dashboard.get_car_model_datalist", ["models" => $models])->render()];
   }


}
