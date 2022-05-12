<?php

namespace App\Listeners;

use App\Events\CarCreatedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use function App\Http\Controllers\ech;

class CarCreatedListener {
   /**
    * Create the event listener.
    *
    * @return void
    */
   public function __construct() {
      //
   }

   /**
    * Handle the event.
    *
    * @param \App\Events\CarCreatedEvent $event
    * @return void
    */
   public function handle(CarCreatedEvent $event) {
      $car_title = $event->car->title . $event->car->production_year;
//      ech("СОХРАНЕНА car " . $car_title);
      return false;
   }
}
