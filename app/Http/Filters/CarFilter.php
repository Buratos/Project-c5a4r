<?php


namespace App\Http\Filters;


use Illuminate\Database\Eloquent\Builder;

class CarFilter extends AbstractFilter {
   public const BRAND_ID = 'brand_id';
   public const CAR_MODEL_ID = 'car_model_id';
   public const BODY_TYPE_ID = 'body_type_id';
   public const ENGINE_TYPE_ID = 'engine_type_id';
   public const COLOR_ID = 'color_id';
   public const TRANSMISSION_TYPE_ID = 'transmission_type_id';
   public const VEHICLE_DRIVE_TYPE_ID = 'vehicle_drive_type_id';
   public const USER_ID = 'user_id';
   public const PRODUCTION_COUNTRY_ID = 'production_country_id';
   public const ENGINE_CAPACITY = 'engine_capacity';
   public const ENGINE_POWER = 'engine_power';
   public const PRODUCTION_YEAR = 'production_year';
   public const NUMBER_DOORS = 'number_doors';
   public const NUMBER_PLACES = 'number_places';
   public const LENGTH = 'length';
   public const WIDTH = 'width';
   public const HEIGHT = 'height';
   public const PRICE = 'price';
   public const MILEAGE = 'mileage';
   public const WAS_IN_ACCIDENT = 'was_in_accident';


   public function brandId(Builder $builder, $value) {
      if (is_array($value)) $builder->whereIn(self::BRAND_ID, $value);
      else $builder->where(self::BRAND_ID, $value);
   }

   public function carModelId(Builder $builder, $value) {
      if (is_array($value)) $builder->whereIn(self::CAR_MODEL_ID, $value);
      else $builder->where(self::CAR_MODEL_ID, $value);
   }

   public function engineTypeId(Builder $builder, $value) {
      if (is_array($value)) $builder->whereIn(self::ENGINE_TYPE_ID, $value);
      else $builder->where(self::ENGINE_TYPE_ID, $value);
   }

   public function colorId(Builder $builder, $value) {
      if (is_array($value)) $builder->whereIn(self::COLOR_ID, $value);
      else $builder->where(self::COLOR_ID, $value);
   }

   public function transmissionTypeId(Builder $builder, $value) {
      if (is_array($value)) $builder->whereIn(self::TRANSMISSION_TYPE_ID, $value);
      else $builder->where(self::TRANSMISSION_TYPE_ID, $value);
   }

   public function vehicleDriveTypeId(Builder $builder, $value) {
      if (is_array($value)) $builder->whereIn(self::VEHICLE_DRIVE_TYPE_ID, $value);
      else $builder->where(self::VEHICLE_DRIVE_TYPE_ID, $value);
   }

   public function productionCountryId(Builder $builder, $value) {
      if (is_array($value)) $builder->whereIn(self::PRODUCTION_COUNTRY_ID, $value);
      else $builder->where(self::PRODUCTION_COUNTRY_ID, $value);
   }

   // filter with range like 1000 - 1999
   public function engineCapacity(Builder $builder, $value) {
      if (is_array($value)) {
         $builder->where(function ($query) use ($value) {
            foreach ($value as $one_value)
               $query->orWhereBetween(self::ENGINE_CAPACITY, explode("-", $one_value));
         });
      } else
         $builder->whereBetween(self::ENGINE_CAPACITY, explode("-", $value));
   }

   // filter with one range
   public function enginePower(Builder $builder, $value) {
      $builder->whereBetween(self::ENGINE_POWER, explode("-", $value));
   }

   // filter with one range
   public function length(Builder $builder, $value) {
      $builder->whereBetween(self::LENGTH, explode("-", $value));
   }

   // filter with one range
   public function width(Builder $builder, $value) {
      $builder->whereBetween(self::WIDTH, explode("-", $value));
   }

   // filter with one range
   public function height(Builder $builder, $value) {
      $builder->whereBetween(self::HEIGHT, explode("-", $value));
   }

   // filter with one range
   public function price(Builder $builder, $value) {
      $builder->whereBetween(self::PRICE, explode("-", $value));
   }

   // filter with one range
   public function mileage(Builder $builder, $value) {
      $builder->whereBetween(self::MILEAGE, explode("-", $value));
   }

   public function productionYear(Builder $builder, $value) {
      if (is_array($value)) $builder->whereIn(self::PRODUCTION_YEAR, $value);
      else $builder->where(self::PRODUCTION_YEAR, $value);
   }

   public function wasInAccident(Builder $builder, $value) {
      if (is_array($value)) $builder->whereIn(self::WAS_IN_ACCIDENT, $value);
      else $builder->where(self::WAS_IN_ACCIDENT, $value);
   }

   public function numberDoors(Builder $builder, $value) {
      if (is_array($value)) $builder->whereIn(self::NUMBER_DOORS, $value);
      else $builder->where(self::NUMBER_DOORS, $value);
   }

   public function numberPlaces(Builder $builder, $value) {
      if (is_array($value)) $builder->whereIn(self::NUMBER_PLACES, $value);
      else $builder->where(self::NUMBER_PLACES, $value);
   }


   /*   protected function is_range($value) {
         return strpos($value, "-") !== false;
      }*/

   protected function getCallbacks(): array {
      return [
        self::BRAND_ID              => [$this, 'brandId'],
        self::CAR_MODEL_ID          => [$this, 'carModelId'],
        self::ENGINE_TYPE_ID        => [$this, 'engineTypeId'],
        self::COLOR_ID              => [$this, 'colorId'],
        self::TRANSMISSION_TYPE_ID  => [$this, 'transmissionTypeId'],
        self::VEHICLE_DRIVE_TYPE_ID => [$this, 'vehicleDriveTypeId'],
        self::PRODUCTION_COUNTRY_ID => [$this, 'productionCountryId'],
        self::ENGINE_CAPACITY       => [$this, 'engineCapacity'],
        self::ENGINE_POWER          => [$this, 'enginePower'],
        self::LENGTH                => [$this, 'length'],
        self::WIDTH                 => [$this, 'width'],
        self::HEIGHT                => [$this, 'height'],
        self::PRICE                 => [$this, 'price'],
        self::MILEAGE               => [$this, 'mileage'],
        self::PRODUCTION_YEAR       => [$this, 'productionYear'],
        self::WAS_IN_ACCIDENT       => [$this, 'wasInAccident'],
        self::NUMBER_DOORS          => [$this, 'numberDoors'],
        self::NUMBER_PLACES         => [$this, 'numberPlaces']
      ];
   }
}
