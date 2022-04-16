<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Artisan::call('view:clear');

Route::get('catalog/{brand}', [\App\Http\Controllers\CarController::class, "display_catalog"]);
Route::get('/', function () {
  return view('main_page__carcass');
});
Route::get('/', [\App\Http\Controllers\CarController::class, "index"]);
Route::get('tests', [\App\Http\Controllers\CarController::class, "tests"]);
Route::get('dashboard', [\App\Http\Controllers\CarController::class, "dashboard"]);
Route::get('add', [\App\Http\Controllers\CarController::class, "add"]);
Route::get('html', function () {
  return file_get_contents("index.html");
// return view('main_page_template');
});

/* обработка запросов AJAX-POST */
//Route::post('load_car_model_datalist', [\App\Http\Controllers\CarController::class, "get_car_model_datalist"]);

Route::post('load_car_model_datalist', [\App\Http\Controllers\CarModelController::class, "get_car_model_datalist"]);
Route::post('load_filters_numbers', [\App\Http\Controllers\CarController::class, "get_filters_numbers"]);
Route::post('default_content_load_more', [\App\Http\Controllers\CarController::class, "default_content_load_more"]);
Route::post('load_filtered_content', [\App\Http\Controllers\CarController::class, "load_filtered_content"]);
Route::post('receive_and_save_new_ad', [\App\Http\Controllers\CarController::class, "create"]);
Route::post('receive_and_update_model', [\App\Http\Controllers\CarController::class, "update"]);


