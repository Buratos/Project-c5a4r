<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model {
  use HasFactory;

  public function cars() {
    return $this->hasMany(Car::class);
  }

  public function carModels() {
    return $this->hasMany(CarModel::class);
  }

  public function getModelsAttribute() {
//    $t = $this->carModels;
    return $this->carModels->pluck("title")->toArray();
  }

}
