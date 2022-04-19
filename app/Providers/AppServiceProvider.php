<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;


class AppServiceProvider extends ServiceProvider {
   /**
    * Register any application services.
    *
    * @return void
    */
   public function register() {
      //
   }

   /**
    * Bootstrap any application services.
    *
    * @return void
    */
   public function boot() {
      Paginator::useBootstrap();

      // включение или отключение моего режима отладки - включен если есть файл DEBUG_ON
      // если файла app/DEBUG_ON нету, то режим отладки не включается
      if (file_exists("../app/DEBUG_ON")) View::share('debug_mode_on', 1);
   }
}
