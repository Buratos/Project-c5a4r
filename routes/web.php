<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ErrorController;

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

//Artisan::call('view:clear');
/*Route::get('/test_queue', [\App\Http\Controllers\CarController::class, "test_queue"])->name("test_queue");*/

// ****  PAGES  **************************************************
Route::group(["namespace" => "\App\Http\Controllers\Car"], function () {
   Route::get('/', "IndexController")->name("car.index");
   Route::get('/view_car/{id}', "ViewController")->name("car.view");
   Route::get('/delete_car/{id}', "DeleteController")->name("car.delete")->middleware("car.update");
   Route::get('/create', "CreateController")->name("car.create")->middleware("car.create");
   Route::post('/receive_and_save_new_ad', "StoreController")->name("car.store")->middleware("car.create");
   Route::get('/edit_car/{id}', "EditController")->name("car.edit")->middleware("car.update");
   Route::post('/update_car/{id}', "UpdateController")->name("car.update")->middleware("car.update");
   Route::get('/search', "SearchController")->name("show_search_results");

});
// ****  ADMIN PANEL  **************************************************
Route::group(["namespace" => "\App\Http\Controllers\Admin",/* "prefix" => "admin",*/ "middleware" => "users_role_check"], function () {
   Route::group(["namespace" => "Car"], function () {
      Route::get('/admin/car', IndexController::class)->name("admin.car.index");
      /*   Route::get('/add/', CreateController::class)->name("admin.add");
         Route::get('/edit_car/{id}', UpdateController::class)->name("admin.edit");
         Route::get('/view_car/{id}', ViewController::class)->name("admin.view");
         Route::post('/receive_and_save_new_ad', StoreController::class)->name("admin.store");
         Route::post('/receive_and_update_model', UpdateController::class)->name("admin.update");
         Route::get('/delete_car/{id}', DeleteController::class)->name("admin.delete");
         Route::get('/search', SearchController::class)->name("show_search_results");*/
   });
   Route::get('/admin', function () {
      return redirect()->route("admin.car.index");
   });
   Route::get('/dashboard', function () {
      return redirect()->route("admin.car.index");
   });
});

// ****  ERRORS  **************************************************
Route::group(["namespace" => "\App\Http\Controllers", "prefix" => "error"], function () {
   Route::get('/no_permission', "ErrorController@no_permission")->name("error.no_permission");

});

//Route::get('/delete_car/{id}', [\App\Http\Controllers\CarController::class, "delete"])->name("delete_car");
//Route::get('/view_car/{id}', [\App\Http\Controllers\CarController::class, "view"])->name("car.view");
//Route::get('/edit_car/{id}', [\App\Http\Controllers\CarController::class, "edit"])->name("edit_car");
//Route::get('/', [\App\Http\Controllers\CarController::class, "index"]);
//Route::get('/add/', [\App\Http\Controllers\CarController::class, "add"]);
/*Route::get('/search', [\App\Http\Controllers\CarController::class, "show_search_results"])->name("show_search_results");*/

Route::get('/catalog/{brand}', [\App\Http\Controllers\CarController::class, "display_catalog"]);

/*       обработка запросов AJAX-POST */
//Route::post('load_car_model_datalist', [\App\Http\Controllers\CarController::class, "get_car_model_datalist"]);

Route::post('/dynamic_search', [\App\Http\Controllers\CarController::class, "dynamic_search"])->name("dynamic_search");
Route::post('/load_car_model_datalist', [\App\Http\Controllers\CarModelController::class, "get_car_model_datalist"])->name("car.load_model_datalist");
Route::post('/load_filters_numbers', [\App\Http\Controllers\CarController::class, "get_filters_numbers"]);
Route::post('/default_content_load_more', [\App\Http\Controllers\CarController::class, "default_content_load_more"]);
Route::post('/load_filtered_content', [\App\Http\Controllers\CarController::class, "load_filtered_content"]);
/*Route::post('/receive_and_save_new_ad', [\App\Http\Controllers\CarController::class, "create"]);
Route::post('/receive_and_update_model', [\App\Http\Controllers\CarController::class, "update"]);*/


// разные тесты и пробы
Route::get('/adminlte_source', \App\Http\Controllers\Admin\AdminlteSourceController::class)->name("admin_source.index");
Route::get('/tests', [\App\Http\Controllers\TestController::class, "tests"]);
// тест секцций в блэйде - секции не работают, гадство !
Route::get('/test_edit', [\App\Http\Controllers\CarController::class, "test_edit"])->name("test_edit");

Route::get('/tests/sections', [\App\Http\Controllers\TestController::class, "sections"])->name("tests_sections_home");
Route::get('/tests/sections/goods', [\App\Http\Controllers\TestController::class, "sections_goods"])->name("tests_sections_goods");
Route::get('/tests/sections/services', [\App\Http\Controllers\TestController::class, "sections_services"])->name("tests_sections_services");
Route::get('/tests/sections/delivery', [\App\Http\Controllers\TestController::class, "sections_delivery"])->name("tests_sections_delivery");
Route::get('/tests/sections/contact', [\App\Http\Controllers\TestController::class, "sections_contact"])->name("tests_sections_contact");
/*Route::get('/html', function () {
   return file_get_contents("index.html");
});*/


Auth::routes();

Route::get('/auth', [App\Http\Controllers\AuthController::class, 'index'])->name('auth_index');
