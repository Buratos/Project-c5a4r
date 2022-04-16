<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->foreignId("brand_id")->default(1);
            $table->foreignId("car_model_id")->default(1);
            $table->foreignId("body_type_id")->default(1);
            $table->foreignId("engine_type_id")->default(1);
            $table->foreignId("color_id")->default(1);
            $table->foreignId("transmission_type_id")->default(1);
            $table->foreignId("vehicle_drive_type_id")->default(1);
            $table->foreignId("user_id")->default(1);
            $table->foreignId("production_country_id")->default(1);
            $table->integer("engine_capacity")->default(1500);
            $table->integer("engine_power")->default(100);
            $table->float("fuel_consumption_highway")->default(8);
            $table->float("fuel_consumption_city")->default(13);
            $table->float("fuel_consumption_mixed")->default(11);
            $table->integer("model_year")->default(2010);
            $table->integer("production_year")->default(2010);
            $table->tinyInteger("number_doors")->default(4);
            $table->tinyInteger("number_places")->default(5);
            $table->integer("length")->default(4400);
            $table->integer("width")->default(1760);
            $table->integer("height")->default(1750);
            $table->integer("price")->default(10000);
            $table->integer("mileage")->default(10000);
            $table->boolean("was_in_accident")->default(false);
            $table->text("description");
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cars');
    }
}
