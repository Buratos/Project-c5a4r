<?php

namespace Database\Seeders;

use App\Models\BodyType;
use App\Models\Car;
use Illuminate\Database\Seeder;

class BodyTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BodyType::factory()->count(12)->create();
        $body_types = BodyType::all();
        foreach (Car::all() as $car) {
            $car->body_type_id = $body_types->random()->id;
            $car->save();
        }
    }
}
