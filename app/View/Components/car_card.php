<?php

namespace App\View\Components;

use Illuminate\View\Component;

class car_card extends Component {
      public $urlForCard, $carPhotoUrl, $carTitle, $carPrice, $carParameters;

   /**
    * Create a new component instance.
    *
    * @return void
    */
   public function __construct($urlForCard, $carPhotoUrl, $carTitle, $carPrice, $carParameters) {
      $this->$urlForCard = $urlForCard;
      $this->$carPhotoUrl = $carPhotoUrl;
      $this->$carTitle = $carTitle;
      $this->$carPrice = $carPrice;
      $this->$carParameters = $carParameters;
   }

   /**
    * Get the view / contents that represent the component.
    *
    * @return \Illuminate\Contracts\View\View|\Closure|string
    */
   public function render() {
      return view('components.car_card');
   }
}
