<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use function Psy\debug;

class Car extends Model {
   use HasFactory;

   protected $guarded = [];

   /*
      Returns the search results for search in the head of page
   */
   public static function get_search_results(Request $request) {
      $results_limit = 10000000;
      $cars_per_page = 15;

      $cars = search($request, $results_limit);
      return ["cars" => $cars->Paginate($cars_per_page)->appends("search_str", $request->search_str), "cars_number" => $cars->count()];
   }

   /*
      вызывается для записи новой машины/row в БД
   */
   static function create($request) {
      $files = $request->allFiles();
      $data = $_POST;
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

      return $data["brand"] . " " . $data["car_model"] . " " . $data["production_year"];
   }

   /*********************************************************************
    * просмотр записи / машины / row
    */
   static function view(Request $request) {
      return Car::whereId($request->id)->first();
   }

   /*********************************************************************
    * просмотр записи / машины / row
    */
   static function edit(Request $request) {

   }

   /*********************************************************************
    * выдаёт отфильтрованный фильтрами контент
    */
   static function get_filtered_content() {
      $cars = Car::query();
      $cars->where("price", "<", 15000)->get();

      return $cars;
   }

   static function dynamic_search(Request $request) {
      $results_limit = 20;

      $cars = search($request, $results_limit)->get();

      // convert found cars to the result array of car->title + car->id
      $cars = $cars->slice(0, 1000);
      $found_cars = [];
      foreach ($cars as $car) {
         $title = $car->title . "    " . $car->production_year . "       " . number_format($car->price, 0, "", " ") . " $";
         $found_cars[] = ["title" => $title, "id" => $car->id];
      }
      return collect($found_cars)->sortBy("title");

   }

   static function get_filters($checked_filters_from_site = [], $json = false) {
      $global_start_time = microtime(true);
      $start_time = microtime(true);
      $checked_number = count($checked_filters_from_site);

      $brands = [];
      $brands_checked_count = 0;
      $checked_brand_title = "";
      $data = Brand::select("title", "id")->get()->sortBy("title");
      foreach ($data as $value) {
         $checked = isset($checked_filters_from_site["brand"]) ? in_array($value->title, $checked_filters_from_site["brand"]) : false;
         if ($checked) {
            $brands_checked_count++;
            $checked_brand_title = $value->title;
         }
         if ($checked_number) $count = count_one_filter_number("brand", $value->title, $checked_filters_from_site);
         else $count = Car::where("brand_id", $value->id)->count();
         $brands[$value->title] = ["count" => $count, "id" => $value->id, "checked" => $checked, "value" => $value->title];
      }
//    echo 'Время выполнения $brands: ' . round(microtime(true) - $start_time, 2) . ' сек.<br>';
      $start_time = microtime(true);

      $car_models = [];
      $car_models_checked_count = 0;
      if ($brands_checked_count == 1) {
         $data = Brand::where("title", $checked_brand_title)->first()->carModels->sortBy("title");
         /*      $data = Brand::where("title", $checked_brand_title)->first();
               $data = $data->carModels->sortBy("title");*/
         foreach ($data as $value) {
            $checked = isset($checked_filters_from_site["car_model"]) ? in_array($value->title, $checked_filters_from_site["car_model"]) : false;
            if ($checked) $car_models_checked_count++;
            if ($checked_number) $count = count_one_filter_number("car_model", $value->title, $checked_filters_from_site);
            else $count = Car::where("car_model_id", $value->id)->count();
            $car_models[$value->title] = ["count" => $count, "id" => $value->id, "checked" => $checked, "value" => $value->title];
         }
      }
//    echo 'Время выполнения $car_models: ' . round(microtime(true) - $start_time, 2) . ' сек.<br>';
      $start_time = microtime(true);

      $production_years = [];
      $production_years_checked_count = 0;
      $data = Car::pluck("production_year")->unique()->sortDesc();;
      foreach ($data as $value) {
         $checked = isset($checked_filters_from_site["production_year"]) ? in_array($value, $checked_filters_from_site["production_year"]) : false;
         if ($checked) $production_years_checked_count++;
         if ($checked_number) $count = count_one_filter_number("production_year", $value, $checked_filters_from_site);
         else $count = Car::where("production_year", $value)->count();
         $production_years[$value] = ["count" => $count, "id" => $value, "checked" => $checked, "value" => $value];
      }
//    echo 'Время выполнения $production_years: ' . round(microtime(true) - $start_time, 2) . ' сек.<br>';
      $start_time = microtime(true);

      $car_body_types = [];
      $car_body_types_checked_count = 0;
      $data = BodyType::select("title", "id")->get()->sortBy("title");
      foreach ($data as $value) {
         $checked = isset($checked_filters_from_site["body_type"]) ? in_array($value->title, $checked_filters_from_site["body_type"]) : false;
         if ($checked) $car_body_types_checked_count++;
         if ($checked_number) $count = count_one_filter_number("body_type", $value->title, $checked_filters_from_site);
         else $count = Car::where("body_type_id", $value->id)->count();

         $car_body_types[$value->title] = ["count" => $count, "id" => $value->id, "checked" => $checked, "value" => $value->title];
      }

//    echo 'Время выполнения $car_body_types: ' . round(microtime(true) - $start_time, 2) . ' сек.<br>';
      $start_time = microtime(true);

      $colors = [];
      $colors_checked_count = 0;
      $data = Color::select("title", "id")->get()->sortBy("title");
      foreach ($data as $value) {
         $checked = isset($checked_filters_from_site["color"]) ? in_array($value->title, $checked_filters_from_site["color"]) : false;
         if ($checked) $colors_checked_count++;
         if ($checked_number) $count = count_one_filter_number("color", $value->title, $checked_filters_from_site);
         else $count = Car::where("color_id", $value->id)->count();
         $colors[$value->title] = ["count" => $count, "value" => $value->value, "id" => $value->id, "checked" => $checked, "value" => $value->title];
      }

//    echo 'Время выполнения $colors: ' . round(microtime(true) - $start_time, 2) . ' сек.<br>';
      $start_time = microtime(true);

      $number_doors = [];
      $number_doors_checked_count = 0;
      $data = [2, 3, 4, 5];
      foreach ($data as $value) {
         $checked = isset($checked_filters_from_site["number_doors"]) ? in_array($value, $checked_filters_from_site["number_doors"]) : false;
         if ($checked) $number_doors_checked_count++;
         if ($checked_number) $count = count_one_filter_number("number_doors", $value, $checked_filters_from_site);
         else $count = Car::where("number_doors", $value)->count();
         $number_doors[$value] = ["count" => $count, "id" => $value, "checked" => $checked, "value" => $value];
      }

//    echo 'Время выполнения $number_doors: ' . round(microtime(true) - $start_time, 2) . ' сек.<br>';
      $start_time = microtime(true);

      $number_places = [];
      $number_places_checked_count = 0;
      $data = [2, 3, 4, 5, 6, 7];
      foreach ($data as $value) {
         $checked = isset($checked_filters_from_site["number_places"]) ? in_array($value, $checked_filters_from_site["number_places"]) : false;
         if ($checked) $number_places_checked_count++;
         if ($checked_number) $count = count_one_filter_number("number_places", $value, $checked_filters_from_site);
         else $count = Car::where("number_places", $value)->count();
         $number_places[$value] = ["count" => $count, "id" => $value, "checked" => $checked, "value" => $value];
      }

//    echo 'Время выполнения $number_places: ' . round(microtime(true) - $start_time, 2) . ' сек.<br>';
      $start_time = microtime(true);

      $vehicle_drive_types = [];
      $vehicle_drive_types_checked_count = 0;
      $data = VehicleDriveType::select("title", "id")->get()->sortBy("title");
      foreach ($data as $value) {
         $checked = isset($checked_filters_from_site["vehicle_drive_type"]) ? in_array($value->title, $checked_filters_from_site["vehicle_drive_type"]) : false;
         if ($checked) $colors_checked_count++;
         if ($checked_number) $count = count_one_filter_number("vehicle_drive_type", $value->title, $checked_filters_from_site);
         else $count = Car::where("vehicle_drive_type_id", $value->id)->count();
         $vehicle_drive_types[$value->title] = ["count" => $count, "id" => $value->id, "checked" => $checked, "value" => $value->title];
      }

//    echo 'Время выполнения $vehicle_drive_types: ' . round(microtime(true) - $start_time, 2) . ' сек.<br>';
      $start_time = microtime(true);

      $transmission_types = [];
      $transmission_types_checked_count = 0;
      $data = TransmissionType::select("title", "id")->get()->sortBy("title");
      foreach ($data as $value) {
         $checked = isset($checked_filters_from_site["transmission_type"]) ? in_array($value->title, $checked_filters_from_site["transmission_type"]) : false;
         if ($checked) $transmission_types_checked_count++;
         if ($checked_number) $count = count_one_filter_number("transmission_type", $value->title, $checked_filters_from_site);
         else $count = Car::where("transmission_type_id", $value->id)->count();
         $transmission_types[$value->title] = ["count" => $count, "id" => $value->id, "checked" => $checked, "value" => $value->title];
      }

//    echo 'Время выполнения $transmission_types: ' . round(microtime(true) - $start_time, 2) . ' сек.<br>';
      $start_time = microtime(true);

      $engine_types = [];
      $engine_types_checked_count = 0;
      $data = EngineType::select("title", "id")->get()->sortBy("title");
      foreach ($data as $value) {
         $checked = isset($checked_filters_from_site["engine_type"]) ? in_array($value->title, $checked_filters_from_site["engine_type"]) : false;
         if ($checked) $engine_types_checked_count++;
         if ($checked_number) $count = count_one_filter_number("engine_type", $value->title, $checked_filters_from_site);
         else $count = Car::where("engine_type_id", $value->id)->count();
         $engine_types[$value->title] = ["count" => $count, "id" => $value->id, "checked" => $checked, "value" => $value->title];
      }

//    echo 'Время выполнения $engine_types: ' . round(microtime(true) - $start_time, 2) . ' сек.<br>';
      $start_time = microtime(true);

      $engine_capacities = [];
      $engine_capacities_checked_count = 0;
      $data = [["title" => "0.5L - 0.99L", "from" => 500, "to" => 999], ["title" => "1.0L - 1.29L", "from" => 1000, "to" => 1299], ["title" => "1.3L - 1.49L", "from" => 1300, "to" => 1499], ["title" => "1.5L - 1.69L", "from" => 1500, "to" => 1699], ["title" => "1.7L - 1.99L", "from" => 1700, "to" => 1999], ["title" => "2.0L - 2.39L", "from" => 2000, "to" => 2399], ["title" => "2.4L - 2.99L", "from" => 2400, "to" => 2999], ["title" => "3.0L - 3.49L", "from" => 3000, "to" => 3499], ["title" => "3.5L - 3.99L", "from" => 3500, "to" => 3999], ["title" => "4.0L - 4.99L", "from" => 4000, "to" => 4999], ["title" => "5.0L - 5.99L", "from" => 5000, "to" => 5999], ["title" => "6.0L - 10L", "from" => 6000, "to" => 10000]];
      foreach ($data as $value) {
         $checked = isset($checked_filters_from_site["engine_capacity"]) ? in_array($value, $checked_filters_from_site["engine_capacity"]) : false;
         if ($checked) $engine_capacities_checked_count++;
         if ($checked_number) $count = count_one_filter_number("engine_capacity", $value["title"], $checked_filters_from_site);
         else $count = Car::whereBetween("engine_capacity", [$value["from"], $value["to"]])->count();

         $engine_capacities[$value["title"]] = ["count" => $count, "id" => "from" . $value["from"], "checked" => $checked, "value" => $value["title"] /*$value["from"] . "___" . $value["to"]*/];
      }

      //    echo 'Время выполнения $colors: ' . round(microtime(true) - $start_time, 2) . ' сек.<br>';
      $start_time = microtime(true);

      $was_in_accident = [];
      $was_in_accident_checked_count = 0;
      $data = [0, 1];
      foreach ($data as $value) {
         $checked = isset($checked_filters_from_site["was_in_accident"]) ? in_array($value, $checked_filters_from_site["was_in_accident"]) : false;
         if ($checked) $number_doors_checked_count++;
         if ($checked_number) $count = count_one_filter_number("was_in_accident", $value, $checked_filters_from_site);
         else $count = Car::where("was_in_accident", $value)->count();
         $was_in_accident[$value] = ["count" => $count, "id" => $value, "checked" => $checked, "value" => $value];
      }

//    echo 'Время выполнения $engine_capacities: ' . round(microtime(true) - $start_time, 2) . ' сек.<br>';

      $start_time = microtime(true);


      $engine_powers = ["from" => 0, "to" => 0];
      $engine_powers_checked_count = 0;

      $car_mileages = ["from" => 0, "to" => 0];
      $car_mileages_checked_count = 0;

      $dimensions = ["length" => ["from" => 0, "to" => 0], "width" => ["from" => 0, "to" => 0], "height" => ["from" => 0, "to" => 0]];
      $dimensions_checked_count = 0;


      //    var_dump($brands);
      $filters = [];
      $filters["brand"] = $brands;
      $filters["car_model"] = $car_models;
      $filters["body_type"] = $car_body_types;
      $filters["production_year"] = $production_years;
      $filters["color"] = $colors;
      $filters["number_doors"] = $number_doors;
      $filters["number_places"] = $number_places;
      $filters["vehicle_drive_type"] = $vehicle_drive_types;
      $filters["transmission_type"] = $transmission_types;
      $filters["engine_type"] = $engine_types;
      $filters["engine_capacity"] = $engine_capacities;
      $filters["engine_power"] = $engine_powers;
      $filters["car_mileage"] = $car_mileages;
      $filters["dimensions"] = $dimensions;
      $filters["was_in_accident"] = $was_in_accident;

      if (!$json) {
         $filters["brand_checked_count"] = $brands_checked_count;
         $filters["car_model_checked_count"] = $car_models_checked_count;
         $filters["production_year_checked_count"] = $production_years_checked_count;
         $filters["body_type_checked_count"] = $car_body_types_checked_count;
         $filters["color_checked_count"] = $colors_checked_count;
         $filters["number_doors_checked_count"] = $number_doors_checked_count;
         $filters["number_places_checked_count"] = $number_places_checked_count;
         $filters["vehicle_drive_type_checked_count"] = $vehicle_drive_types_checked_count;
         $filters["transmission_type_checked_count"] = $transmission_types_checked_count;
         $filters["engine_type_checked_count"] = $engine_types_checked_count;
         $filters["engine_capacity_checked_count"] = $engine_capacities_checked_count;
         $filters["engine_power_checked_count"] = $engine_powers_checked_count;
         $filters["car_mileage_checked_count"] = $car_mileages_checked_count;
         $filters["dimensions_checked_count"] = $dimensions_checked_count;
         $filters["was_in_accident_checked_count"] = $was_in_accident_checked_count;
      }
      if ($checked_filters_from_site == []) $total_cars_found = Car::select("*")->count();
      else $total_cars_found = count_one_filter_number("", "", $checked_filters_from_site, true);
//    echo 'Время выполнения ГЛОБАЛЬНО: ' . round(microtime(true) - $global_start_time, 2) . ' сек.<br>';

      $cars = Car::whereHas("brand", function ($query) {
         $query->where("title", "Fiat");
      })->Paginate(15);
      $cars->withPath("/");

      return ["filters" => $filters, "total_cars_found" => $total_cars_found, "template" => view("main_page.paginator_test", ["cars" => $cars])->render()];
   }

   /*

   */

   public function user() {
      return $this->belongsTo(User::class);
   }

   public function brand() {
      return $this->belongsTo(Brand::class);
   }

   public function productionCountry() {
      return $this->belongsTo(ProductionCountry::class);
   }

   public function carModel() {
      return $this->belongsTo(CarModel::class);
   }

   public function color() {
      return $this->belongsTo(Color::class);
   }

   public function bodyType() {
      return $this->belongsTo(BodyType::class);
   }

   public function engineType() {
      return $this->belongsTo(EngineType::class);
   }

   public function transmissionType() {
      return $this->belongsTo(TransmissionType::class);
   }

   public function vehicleDriveType() {
      return $this->belongsTo(VehicleDriveType::class);
   }

   public function carPhotos() {
      return $this->hasMany(CarPhoto::class);
   }

   public function getModelAttribute() {
      return $this->carModel->title;
   }

   public function getPhotosAttribute() {
      return $this->carPhotos->pluck("filename")->toArray();
   }

   public function getTitleAttribute() {
      return $this->Brand->title . " " . $this->carModel->title;
   }


}

function count_one_filter_number($filter_category, $filter_value, $checked_filters, $count_only_checked = false) {
   $simple_columns = ["production_year", "number_doors", "number_places", "was_in_accident"];
   $binded_columns = ["brand", "car_model", "body_type", "color", "transmission_type", "vehicle_drive_type", "engine_type"];
   $binded_columns_model_classes = ["brand" => Brand::class, "car_model" => carModel::class, "body_type" => BodyType::class, "color" => Color::class, "transmission_type" => TransmissionType::class, "vehicle_drive_type" => VehicleDriveType::class, "engine_type" => EngineType::class];
   $engine_capacity_data = [["title" => "0.5L - 0.99L", "from" => 500, "to" => 999], ["title" => "1.0L - 1.29L", "from" => 1000, "to" => 1299], ["title" => "1.3L - 1.49L", "from" => 1300, "to" => 1499], ["title" => "1.5L - 1.69L", "from" => 1500, "to" => 1699], ["title" => "1.7L - 1.99L", "from" => 1700, "to" => 1999], ["title" => "2.0L - 2.39L", "from" => 2000, "to" => 2399], ["title" => "2.4L - 2.99L", "from" => 2400, "to" => 2999], ["title" => "3.0L - 3.49L", "from" => 3000, "to" => 3499], ["title" => "3.5L - 3.99L", "from" => 3500, "to" => 3999], ["title" => "4.0L - 4.99L", "from" => 4000, "to" => 4999], ["title" => "5.0L - 5.99L", "from" => 5000, "to" => 5999], ["title" => "6.0L - 10L", "from" => 6000, "to" => 10000]];

   if (!$count_only_checked) {
      $checked = isset($checked_filters[$filter_category]) ? in_array($filter_value, $checked_filters[$filter_category]) : false;
      if ($checked) return "";
      $checked_filters[$filter_category][] = $filter_value;
   }
   $query = Car::query();
   foreach ($checked_filters as $group_name => $filter_values)

      if (in_array($group_name, $simple_columns)) {
         $query->whereIn($group_name, $filter_values);
      } else if (in_array($group_name, $binded_columns)) {
         $id_group = $binded_columns_model_classes[$group_name]::whereIn("title", $filter_values)->pluck("id");
         $query->whereIn($group_name . "_id", $id_group->all());
      } else if ($group_name == "engine_capacity")
         $query->where(function ($query) use ($engine_capacity_data, $group_name, $filter_values) {
            foreach ($filter_values as $value_from_checked_filters) {
               foreach ($engine_capacity_data as $capacity_value)
                  if ($capacity_value["title"] == $value_from_checked_filters) {
                     $query->orWhereBetween($group_name, [$capacity_value["from"], $capacity_value["to"]]);
                     break;
                  }
            }
         });


   $count = $query->count();
   return $count;
}

function search(Request $request, $limit = 20) {
   switch ($request->method()) {
      case "GET" :   // standard search
         $words = str_word_count($request->search_str, 1, '1234567890йцукенгшщзхъфывапролджэячсмитьбюёЙЦУКЕНГШЩЗХЪФЫВАПРОЛДЖЭЯЧСМИТЬБЮЁ');
         break;
      case "POST" :  // dynamic quick search
         $words = str_word_count($request->data, 1, '1234567890йцукенгшщзхъфывапролджэячсмитьбюёЙЦУКЕНГШЩЗХЪФЫВАПРОЛДЖЭЯЧСМИТЬБЮЁ');
         break;
   }
   if (count($words) == 1) {
      if (strlen($words[0]) < 2) return collect();
      $result = collect();
      $brands = brands_search($words[0]);
      if (!$brands) {   // brands not found, looking for models
         $models = models_search($words[0]);
      } else {  // brands found, looking for models of these brands
         $models = collect();
         foreach ($brands as $brand) {
            $s = Brand::whereTitle($brand)->first()->carModels;
            $models = $models->concat($s);
         }
      }
      if (!$models->count()) return Car::whereId(-1);
      $cars = Car::query();
      foreach ($models as $model) {
         $cars->orWhereHas("carModel", function ($query) use ($model) {
            $query->whereTitle($model->title);
         });
         if ($cars->count() >= $limit) break;
      }
   } else {  // 2+ words  - 1-brand & 2-model
      $cars = Car::whereHas("brand", function ($query) use ($words) {
         $query->where("title", "like", "%" . $words[0] . "%");
      })->whereHas("carModel", function ($query) use ($words) {
         $query->where("title", "like", "%" . $words[1] . "%");
      })->limit($limit);
   }
   return $cars;
}


function brands_search($brand_title) {
   $search = Brand::where("title", "like", "%" . $brand_title . "%")->limit(10)->pluck("title")->toArray();

   return $search;
}

function models_search($model, $brand = "") {
   if ($brand) $search = CarModel::where("title", "like", "%" . $model . "%")->whereHas("brand", function ($query) use ($brand) {
      $query->where("title", "like", "%" . $brand . "%");
   })->limit(10);
   else $search = CarModel::where("title", "like", "%" . $model . "%")->limit(10);
   $search = $search->get();
   return $search;
}
