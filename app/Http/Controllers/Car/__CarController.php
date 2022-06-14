<?php

namespace App\Http\Controllers;

use App\Jobs\TestJob;
use App\Mail\PlainTextLetter;
use App\Mail\TestLetter;
use App\Models\BodyType;
use App\Models\Brand;
use App\Models\Car;
use App\Models\Testtable;
use App\Models\Testtest;
use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class CarController extends Controller {


   /*********************************************************************
    * вызывается для выдачи корневой страницы
    */
   public function test_queue() {
      for ($i = 0, $a = 0; $i < 10000; $i++) {
         $a++;
      }

      $cars_per_page = 15;

      $cars = Car::inRandomOrder()->Paginate($cars_per_page);
      $cars_number = Car::count();
      $filters = Car::get_filters();
      return view("main_page._carcass_", ["cars" => $cars, "filters" => $filters["filters"], "total_cars_found" => $filters["total_cars_found"], "cars_per_page" => $cars_per_page, "cars_number" => $cars_number, "brands" => Brand::pluck("title")->toArray()]);
   }

   /*********************************************************************
    */
   public function test_edit(Request $request) {
      /*      $car = Car::whereId($request->id)->first();
            if (!$car) $response = ["error_message" => "No such car found :(",];
            else {
               $brand_titles = Brand::orderBy("title")->pluck("title", "id");
               $body_type_titles = BodyType::orderBy("title")->pluck("title", "id");

               $car_title = $car->title . " " . $car->production_year;
               $response = ["edit_car_page" => 1, "car" => $car, "car_title" => $car_title, "brand_titles" => $brand_titles, "body_type_titles" => $body_type_titles, "page_title" => "EDIT CAR"];

            }
            return view("main_page._carcass_", $response);*/
      $car = Car::whereId(33/*$request->id*/)->first();
      if (!$car) $response = ["error_message" => "No such car found :("];
      else {
         $car_title = $car->title . " " . $car->production_year;
         $brand_titles = Brand::orderBy("title")->pluck("title", "id");
         $body_type_titles = BodyType::orderBy("title")->pluck("title", "id");

         $response = ["test_edit" => 1, "car" => $car, "car_title" => $car_title, "brand_titles" => $brand_titles, "body_type_titles" => $body_type_titles, "page_title" => "TEST_EDIT"];
      }
      return view("main_page._carcass_", $response);

   }

   public function show_search_results(Request $request) {

      $cars = Car::get_search_results($request);
      if (!$cars["cars"]->count()) return view("main_page._carcass_", ["error_message" => "No cars found"]);
      return view("main_page._carcass_", ["show_search_results" => 1, "cars" => $cars["cars"], "cars_per_page" => 15, "cars_number" => $cars["cars_number"]]);
   }

   /*********************************************************************
    * вызывается для выдачи корневой страницы
    */
   public function display_catalog(Request $request) {
      $cars_per_page = 15;
      if (!isset($request->brand)) return;

      $cars = Car::whereHas("brand", function ($query) use ($request) {
         $query->whereTitle($request->brand);
      });
      $filters = Car::get_filters();
      $cars_number = $cars->count();
      if (!$cars_number) {
         $error = 1;
         $error_message = "No cars for brand '" . $request->brand . "' found.";
         return view("main_page._carcass_", ["error" => $error, "error_message" => $error_message, "filters" => $filters["filters"], "total_cars_found" => $filters["total_cars_found"], "brands" => Brand::pluck("title")->toArray()]);
      }
      $cars = $cars->Paginate($cars_per_page);

      return view("main_page._carcass_", ["catalog" => 1, "cars" => $cars, "filters" => $filters["filters"], "total_cars_found" => $filters["total_cars_found"], "cars_per_page" => $cars_per_page, "cars_number" => $cars_number, "brands" => Brand::pluck("title")->toArray()]);
   }

   /*********************************************************************
    * вызывается для выдачи корневой страницы
    */
   public function index() {
      TestJob::dispatch("function index __ ЗАДАНИЕ ВЫПОЛНЯЕТСЯ из ОЧЕРЕДИ");

      $cars_per_page = 15;

      $cars = Car::inRandomOrder()->Paginate($cars_per_page);
      $cars_number = Car::count();
      $filters = Car::get_filters();
      return view("main_page._carcass_", ["cars" => $cars, "filters" => $filters["filters"], "total_cars_found" => $filters["total_cars_found"], "cars_per_page" => $cars_per_page, "cars_number" => $cars_number, "brands" => Brand::pluck("title")->toArray()]);
   }

   /*********************************************************************
    * записывает новую машину в БД, вызывается из добавления новой машины при получении данных через post
    */
   public function create(Request $request) {

      $car_title = Car::create($request);

      return ["success" => 1, "html" => view("crud.new_ad_saved", ["car_title" => $car_title])->render()];
   }

   /*********************************************************************
    * вызывается для добавления новой машины / в БД
    */
   public function add() {
      $faker = Factory::create();
      $description = $faker->text(1000);
      $brand_titles = Brand::orderBy("title")->pluck("title", "id");
      $body_type_titles = BodyType::orderBy("title")->pluck("title", "id");
      return view("main_page._carcass_", ["create_new_ad_page" => 1, "brand_titles" => $brand_titles, "body_type_titles" => $body_type_titles, "description" => $description]);

   }

   /*********************************************************************
    * просмотр записи / машины / row
    */
   public function view(Request $request) {

      $car = Car::view($request);
      if (!$car) $response = ["error_message" => "No such car found :("];
      else $response = ["view_car_page" => 1, "car" => $car];

      return view("main_page._carcass_", $response);
   }

   /*********************************************************************
    * редактирование записи / машины / row
    */
   public function edit(Request $request) {

      $car = Car::whereId($request->id)->first();
      if (!$car) $response = ["error_message" => "No such car found :("];
      else {
         $brand_titles = Brand::orderBy("title")->pluck("title", "id");
         $body_type_titles = BodyType::orderBy("title")->pluck("title", "id");

         $car_title = $car->title . " " . $car->production_year;
         $response = ["edit_car_page" => 1, "car" => $car, "car_title" => $car_title, "brand_titles" => $brand_titles, "body_type_titles" => $body_type_titles, "page_title" => "EDIT CAR"];

      }
      return view("main_page._carcass_", $response);
   }

   /*********************************************************************
    * удаление записи / машины / row
    */
   public function delete(Request $request) {
      $car_title = Car::delete_car($request);
      $response = ["delete_car" => 1, "message" => "Car " . $car_title . " deleted."];

      return view("main_page._carcass_", $response);
   }

   /*********************************************************************
    * редактирование записи / машины / row
    */
   public function dynamic_search(Request $request) {

      $found_cars = Car::dynamic_search($request);

      if (count($found_cars) > 0) $response = ["success" => 1, "html" => view("search.dynamic_search_list_item", ["found_items" => $found_cars])->render()];
      else $response = ["success" => 0];

      return $response;
   }

   /********************************************************************
    * вызывается при клике по кнопке Load more... под контентом по умолчанию
    */
   public function default_content_load_more(Request $request) {
      $cars_per_page = 15;

      $cars = Car::whereHas("brand", function ($query) {
         $query->where("title", "Nissan");
      })->skip($request->data * $cars_per_page)->limit($cars_per_page)->get();

      $cars_number = Car::whereHas("brand", function ($query) {
         $query->where("title", "Nissan");
      })->limit($cars_per_page)->count();
      $total_loaded_cars = $cars_per_page * ($request->data + 1);
      if ($total_loaded_cars > $cars_number) $total_loaded_cars = $cars_number;

      return ["content" => view("main_page.default_content_load_more", ["cars" => $cars])->render(), "new_already_loaded_pages" => $request->data + 1, "total_loaded_cars" => $total_loaded_cars];
   }

   /*********************************************************************
    * вызывается при клике по кнопке Load more... под контентом по умолчанию
    */
   public function load_filtered_content(Request $request) {
      $cars = Car::get_filtered_content();

      return ["content" => view("filtered.filtered_content", ["cars" => $cars])->render()];
   }


   /*********************************************************************
    * вызывается при клике по фильтру, чтобы пересчитать все числа на фильтрах
    * получает post-запрос через ajax и возвращает json
    */
   public function get_filters_numbers(Request $request) {
      $brands = ["Audi", "BMW", "Opel", "Suzuki", "Peugeot", "Skoda", "Toyota", "Renault", "Kia", "Hyundai", "Fiat", "Cherry", "Ford", "Dodge", "Chrysler", "Mercedes", "Cadillac", "Chevrolet", "Volkswagen", "Nissan", "Honda", "Mitsubishi", "Mazda"];
      $checked_filters = (array)json_decode($request->data);
      $all_filters = ["brands" => ["toyota" => 10, "Ford" => 15], "prices" => [12000, 15000, 8500], "engine_powers" => [200, 150, 170]];

      $filters = Car::get_filters($checked_filters, true);
      return $filters;
   }

   public function dashboard() {
      return view("main_page._carcass_");
   }

}

//  улучшенный echo, просто вывод строки и переход на новую строку
function ech($someone = "") {
   echo $someone . " <br>";
}

