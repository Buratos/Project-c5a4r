<?php

namespace App\Http\Controllers;

use App\Http\Filters\CarFilter;
use App\Http\Requests\InputParametersRequest;
use App\Models\Car;
use Illuminate\Support\Facades\Auth;

class TestController extends Controller {

   public function sections() {
      return view("tests.sections.content_home", ["content" => "home"]);
   }

   public function sections_goods() {
      return view("tests.sections._carcass_", ["content" => "goods"]);
   }

   public function sections_services() {
      return view("tests.sections._carcass_", ["content" => "services"]);
   }

   public function sections_delivery() {
      return view("tests.sections._carcass_", ["content" => "delivery"]);
   }

   public function sections_contact() {
      return view("tests.sections._carcass_", ["content" => "contact"]);
   }

   /*********************************************************************
    * ДЛЯ ЛЮБЫХ ТЕСТОВ ****************************************************************
    */

   public function tests(InputParametersRequest $request) {
      echo "<div style='padding-left: 3rem; text-align: left;font-family:Roboto '>";
      // ▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪
      /*      TestJob::dispatch("ВЫПОЛНЯЕТСЯ из ОЧЕРЕДИ _ запущена из function tests");
            Log::info("Log::info  Тестовое сообщение из function tests  " . now());
            Log::channel('debug')->info("Log::info  Тестовое сообщение из function tests  " . now());
            Log::build([
              'driver' => 'single',
              'path'   => storage_path('logs/custom.log'),
            ])->info('Log::build  Тестовое сообщение из function tests  ');*/

//      Mail::to("zolotoedermo@gmail.com")->cc("xlamspam@mail.ru")->send(new TestLetter());
//      Mail::to("zolotoedermo@gmail.com")->bcc(["xlamspam@mail.ru","7582115@gmail.com"])->send(new PlainTextLetter());
//      dd("request->all() **************", $request->all(),"request()->all() **************", request()->all(),"request()->collect() **************", request()->collect(), "array_filter(request()->all()) ***********", array_filter(request()->all()));
      dd(Auth::user() ? (auth()->user()->isAdmin() ? auth()->user()->name . "  ADMIN" : auth()->user()->name . " is not  ADMIN") : "unknown user");
      dd(Auth::user()->toArray());

      $filter = app()->make(CarFilter::class, ["queryParams" => $request->all()]);
      $cars = Car::filter($filter)->get();
      dd($cars->toArray());

      // ▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪
      echo "</div>";
      return;


      /*      $myfile = fopen("testfile.txt", "a");
            $txt = "public function get_filters_numbers()\n";
            fwrite($myfile, $txt);
            $txt = "---------------------------------------\n";
            fwrite($myfile, $txt);
            fclose($myfile);*/

      $test_str_rus = "Cтрoка тekctа. Проверяю функцию str_word_count.";
      $test_str_eng = "Line of text. Checking the str_word_count function.";
      $rus_words = str_word_count($test_str_rus, 1, '1234567890йцукенгшщзхъфывапролджэячсмитьбюёЙЦУКЕНГШЩЗХЪФЫВАПРОЛДЖЭЯЧСМИТЬБЮЁ');
      $eng_words = str_word_count($test_str_eng, 1, '1234567890йцукенгшщзхъфывапролджэячсмитьбюёЙЦУКЕНГШЩЗХЪФЫВАПРОЛДЖЭЯЧСМИТЬБЮЁ');

      $title = "vectra";
      $additional_search = Car::query();
      $additional_search->whereHas("carModel", function ($query) use ($title) {
         $query->where("title", $title);
      });
      $title = "opel";

      $additional_search->orWhere(function ($query) {
         $query->whereHas("brand", function ($query) {
            $query->where("title", "fiat");
         });
      });
      /*      $additional_search->whereHas("brand", function ($query) use ($title) {
               $query->where("title", $title);
            });*/

      $search = $additional_search->limit(100)->get();

      /*      $search->each(function ($item, $key) {
               ech("ID - " . $item->id);
               ech("BRAND - " . $item->brand->title);
               ech("MODEL - " . $item->model);
               ech("PRICE - " . $item->price);
               ech();
            });*/
      ech("---------------------");

      $words = ["yo", "er"];
      $cars = Car::whereHas("brand", function ($query) use ($words) {
         $query->where("title", "like", "%" . $words[0] . "%");
      })->whereHas("carModel", function ($query) use ($words) {
         $query->where("title", "like", "%" . $words[1] . "%");
      })->limit(1000)->get();

      ech("ВСЕГО НАЙДЕНО - " . $cars->count());
      $cars->each(function ($item, $key) {
         ech("ID - " . $item->id);
         ech("BRAND - " . $item->brand->title);
         ech("MODEL - " . $item->model);
         ech("PRICE - " . $item->price);
         ech();
      });
      ech("---------------------");
      ech();
      $cars = Car::whereHas("carModel", function ($query) use ($words) {
         $query->where("title", "like", "%" . $words[1] . "%");
      })->limit(1000)->get();

      ech("ВСЕГО НАЙДЕНО - " . $cars->count());
      $cars->each(function ($item, $key) {
         ech("ID - " . $item->id);
         ech("BRAND - " . $item->brand->title);
         ech("MODEL - " . $item->model);
         ech("PRICE - " . $item->price);
         ech();
      });

      /*    $start_time = microtime(true);
    echo 'Время выполнения SELECT : <b>' . round(microtime(true) - $start_time, 2) . ' </b> сек.<br>';*/

      /*    $data3 = Car::where("price","<",15000)->orWhereHas("brand", function ($query) {
            $query->where("title", "Kia");
          })->get()*/

      /*      $data = Car::query();
            $data->where("was_in_accident", false);

            ech("найдено - " . $data->count());
            ech();
            $data->get();

            $data->each(function ($item, $key) {
               ech("ID - " . $item->id);
               ech("BRAND - " . $item->brand->title);
               ech("MODEL - " . $item->model);
               ech("ENGINE CAPACITY - " . $item->engine_capacity);
               ech("BODY TYPE - " . $item->bodyType->title);
               ech("PRICE - " . number_format($item->price, 0, "", " ") . " $");
               ech("BODY TYPE - " . $item->bodyType->title);
               ech("TRANSMISSION TYPE - " . $item->transmissionType->title);

               ech();
            });*/
      /*      if (Storage::exists('dc40a269-5296-4e54-9323-4a10170c3190.webp')) {
               ech("dc40a269-5296-4e54-9323-4a10170c3190.webp    СУЩЕСТВУЕТ");
            }
            if (Storage::exists('public/car_photos/dc40a269-5296-4e54-9323-4a10170c3190.webp')) {
               ech("public/car_photos/dc40a269-5296-4e54-9323-4a10170c3190.webp    СУЩЕСТВУЕТ");
            }

            if (Storage::missing('dc40a269-5296-4e54-9323-4a10170c3190.webp')) {
               ech("dc40a269-5296-4e54-9323-4a10170c3190.webp    НЕТУ");
            }
            if (Storage::missing('public/car_photos/dc40a269-5296-4e54-9323-4a10170c3190.webp')) {
               ech("public/car_photos/dc40a269-5296-4e54-9323-4a10170c3190.webp    НЕТУ");
            }

            $img_url = asset("public/car_photos/dc40a269-5296-4e54-9323-4a10170c3190.webp");
            $url = Storage::url('public/car_photos/dc40a269-5296-4e54-9323-4a10170c3190.webp');
            ech("<img src='public/car_photos/dc40a269-5296-4e54-9323-4a10170c3190.webp'>");
      //      ech("<img src='img/dc40a269-5296-4e54-9323-4a10170c3190.webp'>");
            ech("<img src='" . $url2 . "'>");
            ech("<img src='" . $url3 . "'>");*/
   }

}

//  улучшенный echo, просто вывод строки и переход на новую строку
function ech($someone = "") {
   echo $someone . " <br>";
}