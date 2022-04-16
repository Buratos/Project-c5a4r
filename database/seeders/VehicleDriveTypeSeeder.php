<?php

namespace Database\Seeders;

use App\Models\Car;
use App\Models\VehicleDriveType;
use Illuminate\Database\Seeder;

class VehicleDriveTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        VehicleDriveType::factory()->count(3)->create();

        $vd_types = VehicleDriveType::all()->pluck("id");
        foreach (Car::lazy() as $car) {
            $car->vehicle_drive_type_id = $vd_types->random();
            $car->save();
        }
    }
}
