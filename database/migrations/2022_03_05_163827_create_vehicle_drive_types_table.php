<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehicleDriveTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicle_drive_types', function (Blueprint $table) {
            $table->id();
            $table->string("title",30);
            $table->timestamps();
        });
/*        $vehicle_drive_types = ["Полный","Передний","Задний"];
        foreach ($vehicle_drive_types as $value) DB::table("vehicle_drive_types")->insert(["title" => $value]);*/

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vehicle_drive_types');
    }
}
