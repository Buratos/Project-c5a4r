<?php


namespace App\Services\Car;


use App\Events\CarCreatedEvent;
use App\Models\BodyType;
use App\Models\Brand;
use App\Models\Car;
use App\Models\CarModel;
use App\Models\CarPhoto;
use App\Models\Color;
use App\Models\EngineType;
use App\Models\TransmissionType;
use App\Models\User;
use App\Models\VehicleDriveType;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Service {

   public function get_one_car_for_view($request) {
      $car = Car::whereId($request->id)->first();
      if (!$car) $response = ["error_message" => "No such car found :("];
      else $response = ["view_car_page" => 1, "car" => $car];
      return $response;
   }

   public function get_one_car_for_edit($request) {

      $car = Car::whereId($request->id)->first();
      if (!$car) $response = ["error_message" => "No such car found :("];
      else {
         $brand_titles = Brand::orderBy("title")->pluck("title", "id");
         $body_type_titles = BodyType::orderBy("title")->pluck("title", "id");

         $car_title = $car->title . " " . $car->production_year;
         $response = ["edit_car_page" => 1, "car" => $car, "car_title" => $car_title, "brand_titles" => $brand_titles, "body_type_titles" => $body_type_titles, "page_title" => "EDIT CAR"];
      }
      return $response;


   }

   public function store($data) {
      DB::transaction(function () use ($data) {
         $files = request()->allFiles();
         $photos_to_DB = [];
         $number = 0;
         foreach ($files as $file) {
            if ($file->getError()) continue;
            $filename = (string)Str::uuid() . "." . $file->extension();
            $path = Storage::putFileAs("public/car_photos", $file, $filename);
            $number++;
            $photos_to_DB[] = CarPhoto::make(["filename" => $filename, "number" => $number]);
         }

         $fuel_consumption_highway = mt_rand(60, 120) / 10;
         $fuel_consumption_city = $fuel_consumption_highway * 1.6;
         $fuel_consumption_mixed = $fuel_consumption_highway * 1.3;
         $model_year = $data["production_year"] - mt_rand(0, 4);

         $brand_id = Brand::whereTitle($data["brand"])->first();
         if ($brand_id == null) $brand_id = Brand::forceCreate(["title" => $data["brand"]])->id;
         else $brand_id = $brand_id->id;
         $model_id = CarModel::whereTitle($data["car_model"])->first()->id;
         $body_type_id = BodyType::whereTitle($data["body_type"])->first()->id;
         $engine_type_id = EngineType::whereTitle($data["engine_type"])->first()->id;
         $color_id = Color::whereTitle($data["color"])->first()->id;
         $transmission_type_id = TransmissionType::whereTitle($data["transmission_type"])->first()->id;
         $vehicle_drive_type_id = VehicleDriveType::whereTitle($data["vehicle_drive_type"])->first()->id;
         $production_country_id = 10;
//      $user_id = 1;

         $car = User::find(1)->cars()->create(["brand_id" => $brand_id, "car_model_id" => $model_id, "body_type_id" => $body_type_id, "engine_type_id" => $engine_type_id, "color_id" => $color_id, "transmission_type_id" => $transmission_type_id, "vehicle_drive_type_id" => $vehicle_drive_type_id, "production_country_id" => $production_country_id/*, "user_id" => $user_id*/, "engine_capacity" => $data["engine_capacity"], "engine_power" => $data["engine_power"], "fuel_consumption_highway" => $fuel_consumption_highway, "fuel_consumption_city" => $fuel_consumption_city, "fuel_consumption_mixed" => $fuel_consumption_mixed, "model_year" => $model_year, "production_year" => $data["production_year"], "number_doors" => $data["number_doors"], "number_places" => $data["number_places"], "description" => $data["description"], "length" => $data["dimensions_length"], "width" => $data["dimensions_width"], "height" => $data["dimensions_height"], "price" => $data["price"], "mileage" => $data["mileage"], "was_in_accident" => $data["was_in_accident"]]);
         $car->carPhotos()->saveMany($photos_to_DB);

         CarCreatedEvent::dispatch($car);

      });
      return $data["brand"] . " " . $data["car_model"] . " " . $data["production_year"];
   }

   public function update($data) {
      DB::transaction(function () use ($data) {

         $car = Car::whereId($data["id"])->first();
         // kill all old photos
         foreach ($car->carPhotos as $photo) Storage::delete("public/car_photos/" . $photo->filename);
         $car->carPhotos()->delete();

         // save new photos
         $files = request()->allFiles();
         $photos_to_DB = [];
         $number = 0;
         foreach ($files as $file) {
            if ($file->getError()) continue;
            $filename = (string)Str::uuid() . "." . $file->extension();
            $path = Storage::putFileAs("public/car_photos", $file, $filename);
            $number++;
            $photos_to_DB[] = CarPhoto::make(["filename" => $filename, "number" => $number]);
         }
         $car->carPhotos()->saveMany($photos_to_DB);

         // updating
         $fuel_consumption_highway = mt_rand(60, 120) / 10;
         $fuel_consumption_city = $fuel_consumption_highway * 1.6;
         $fuel_consumption_mixed = $fuel_consumption_highway * 1.3;
         $model_year = $data["production_year"] - mt_rand(0, 4);

         $brand_id = Brand::whereTitle($data["brand"])->first();
         if ($brand_id == null) $brand_id = Brand::forceCreate(["title" => $data["brand"]])->id;
         else $brand_id = $brand_id->id;
         $model_id = CarModel::whereTitle($data["car_model"])->first()->id;
         $body_type_id = BodyType::whereTitle($data["body_type"])->first()->id;
         $engine_type_id = EngineType::whereTitle($data["engine_type"])->first()->id;
         $color_id = Color::whereTitle($data["color"])->first()->id;
         $transmission_type_id = TransmissionType::whereTitle($data["transmission_type"])->first()->id;
         $vehicle_drive_type_id = VehicleDriveType::whereTitle($data["vehicle_drive_type"])->first()->id;
         $production_country_id = 10;

         $car->update(["brand_id" => $brand_id, "car_model_id" => $model_id, "body_type_id" => $body_type_id, "engine_type_id" => $engine_type_id, "color_id" => $color_id, "transmission_type_id" => $transmission_type_id, "vehicle_drive_type_id" => $vehicle_drive_type_id, "production_country_id" => $production_country_id/*, "user_id" => $user_id*/, "engine_capacity" => $data["engine_capacity"], "engine_power" => $data["engine_power"], "fuel_consumption_highway" => $fuel_consumption_highway, "fuel_consumption_city" => $fuel_consumption_city, "fuel_consumption_mixed" => $fuel_consumption_mixed, "model_year" => $model_year, "production_year" => $data["production_year"], "number_doors" => $data["number_doors"], "number_places" => $data["number_places"], "description" => $data["description"], "length" => $data["dimensions_length"], "width" => $data["dimensions_width"], "height" => $data["dimensions_height"], "price" => $data["price"], "mileage" => $data["mileage"], "was_in_accident" => $data["was_in_accident"]]);

      });
      return $data["brand"] . " " . $data["car_model"] . " " . $data["production_year"];
   }

}