<?php

namespace App\Http\Controllers\Car;

use App\Http\Controllers\BaseController;
use App\Models\BodyType;
use App\Models\Brand;
use App\Models\Car;
use App\Models\Testtable;
use App\Models\User;
use Faker\Factory;
use Illuminate\Support\Facades\Gate;

/*********************************************************************
 * вызывается для добавления новой машины / в БД
 */
class CreateController extends BaseController {

   public function __invoke() {
      $user = auth()->user();
      if (is_null(auth()->user())) {
         abort(403);
      }

/*      if (!Gate::allows('create')) {
         abort(403);
      }*/
      /*      if (request()->user()->cannot("create",Car::whereId(1)->first())) {
               abort(403);
            }*/

      /*      $response = Gate::inspect('create');

            if ($response->allowed()) {
               dd("Действие разрешено ...");
            } else {
               echo $response->message();
            }*/

//      $this->authorize("create",$user);

      $faker = Factory::create();
      $description = $faker->text(1000);
      $brand_titles = Brand::orderBy("title")->pluck("title", "id");
      $body_type_titles = BodyType::orderBy("title")->pluck("title", "id");

      return view("main_page._carcass_", ["create_new_ad_page" => 1, "brand_titles" => $brand_titles, "body_type_titles" => $body_type_titles, "description" => $description]);
   }
}
