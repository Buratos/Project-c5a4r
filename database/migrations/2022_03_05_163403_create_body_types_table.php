<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBodyTypesTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('body_types', function (Blueprint $table) {
            $table->id();
            $table->string("title", 30);
            $table->timestamps();
        });

/*        $body_types = ["Седан", "Хэтчбек", "Лифтбек", "Купе", "Универсал", "Пикап", "Кроссовер", "Внедорожник", "Кабриолет", "Родстер", "Фургон", "Минивэн"];
        foreach ($body_types as $value) DB::table("body_types")->insert(["title" => $value]);*/
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('body_types');
    }
}
