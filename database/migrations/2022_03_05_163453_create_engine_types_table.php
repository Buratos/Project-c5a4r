<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEngineTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('engine_types', function (Blueprint $table) {
            $table->id();
            $table->string("title",30);
            $table->timestamps();
        });
/*        $engine_types = ["Бензин","Дизель","Гибрид","Электро"];
        foreach ($engine_types as $value) DB::table("engine_types")->insert(["title" => $value]);*/
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('engine_types');
    }
}
