<?php

namespace Database\Seeders;

use App\Models\Car;
use App\Models\EngineType;
use Illuminate\Database\Seeder;

class EngineTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        EngineType::factory()->count(5)->create();
        $engine_types = EngineType::pluck("id");
        foreach (Car::lazy() as $car) {
            $car->engine_type_id = $engine_types->random();
            $car->save();
        }
    }
}
