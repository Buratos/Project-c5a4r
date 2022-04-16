<?php

namespace Database\Seeders;

use App\Models\Car;
use App\Models\Phone;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        User::factory()->count(500)->create()->each(function ($user) {
            $user->phones()->saveMany(Phone::factory()->count(mt_rand(1, 3))->make());
            $user->cars()->saveMany(Car::factory()->count(mt_rand(0, 5))->make());
        });
    }
}

