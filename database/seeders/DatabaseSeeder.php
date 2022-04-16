<?php

namespace Database\Seeders;

use App\Models\CarPhoto;
use App\MyFN;
use App\Models\Car;
use App\Models\Phone;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder {
   /**
    * Seed the application's database.
    *
    * @return void
    */
   public function run() {
      $this->call([UserSeeder::class, BodyTypeSeeder::class, BrandSeeder::class, CarModelSeeder::class, ColorSeeder::class, EngineTypeSeeder::class, ProductionCountrySeeder::class, TransmissionTypeSeeder::class, VehicleDriveTypeSeeder::class]);

      MyFN::erase_dir_tree_inside("storage/app/public/car_photos/");

      // для каждой машины надо добавить фотки
      foreach (Car::lazy() as $car) {
         $brand = $car->brand->title;
         $total_photos = MyFN::count_files("resources/__car_photos_sources/car_photos/" . $brand . "/");
         $photos_for_car = mt_rand(5, 15);
         $file_number_array = [];
         $photos_to_DB = [];

         for ($i = 0; $i < $photos_for_car; $i++) {
            do {
               $file_number = mt_rand(1, $total_photos);
            } while (in_array($file_number, $file_number_array));
            $file_number_array[] = $file_number;
            $uuid = (string)Str::uuid();
            $filename = $file_number . ".webp";
            $filename_output = $uuid . ".webp";
            $from = "resources/__car_photos_sources/car_photos/" . $brand . "/";
            $to = "storage/app/public/car_photos/";
            copy($from . $filename, $to . $filename_output);
            $photos_to_DB[] = CarPhoto::make(["filename" => $filename_output, "number" => $i + 1]);

//        $car->carPhotos()->save(CarPhoto::make(["filename" => $uuid,"number" => $i+1]));

         }
         $car->carPhotos()->saveMany($photos_to_DB);
      }
   }
}

/*public function run() {
   $this->call([UserSeeder::class, BodyTypeSeeder::class, BrandSeeder::class, CarModelSeeder::class, ColorSeeder::class, EngineTypeSeeder::class, ProductionCountrySeeder::class, TransmissionTypeSeeder::class, VehicleDriveTypeSeeder::class]);

   MyFN::erase_dir_tree_inside("public/img/car_photos/");

   // для каждой машины надо добавить фотки
   foreach (Car::lazy() as $car) {
      $brand = $car->brand->title;
      $total_photos = MyFN::count_files("public/img/__tmp/car_photos/" . $brand . "/");
      $photos_for_car = mt_rand(5, 15);
      $file_number_array = [];
      $photos_to_DB = [];

      for ($i = 0; $i < $photos_for_car; $i++) {
         do {
            $file_number = mt_rand(1, $total_photos);
         } while (in_array($file_number, $file_number_array));
         $file_number_array[] = $file_number;
         $uuid = (string)Str::uuid();
         $filename = $file_number . ".webp";
         $filename_output = $uuid . ".webp";
         $from = "public/img/__tmp/car_photos/" . $brand . "/";
         $to = "public/img/car_photos/";
         copy($from . $filename, $to . $filename_output);
         $photos_to_DB[] = CarPhoto::make(["filename" => $uuid,"number" => $i+1]);

//        $car->carPhotos()->save(CarPhoto::make(["filename" => $uuid,"number" => $i+1]));

      }
      $car->carPhotos()->saveMany($photos_to_DB);
   }
}
*/
