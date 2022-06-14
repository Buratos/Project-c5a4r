<?php

namespace App\Http\Controllers\Car;

use App\Http\Controllers\BaseController;
use App\Models\Car;
use App\Models\User;

//use App\Models\Testtable;

/*********************************************************************
 * просмотр записи / машины / row
 */
class EditController extends BaseController {

   public function __invoke() {
/*      $user = auth()->user();
      if (is_null(auth()->user())) {
         dd("ПУСТОЙ юзер");
         abort(403);
      } elseif (auth()->user()->id != request()->id) {
         dd("НЕ АДМИН");
      }
*/

      $response = $this->service->get_one_car_for_edit(request());
      return view("main_page._carcass_", $response);
   }
}

