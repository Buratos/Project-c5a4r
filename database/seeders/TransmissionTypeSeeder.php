<?php

namespace Database\Seeders;

use App\Models\Car;
use App\Models\TransmissionType;
use Illuminate\Database\Seeder;

class TransmissionTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TransmissionType::factory()->count(6)->create();

        $tr_types = TransmissionType::all()->pluck("id");
        foreach (Car::lazy() as $car) {
            $car->transmission_type_id = $tr_types->random();
            $car->save();
        }
    }
}
