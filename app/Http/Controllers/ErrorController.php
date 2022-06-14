<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ErrorController extends Controller {
   public function no_permission() {
      $response = ["error_message" => __("You do not have permission to access this page")];
      return view("main_page._carcass_", $response);
   }
}
