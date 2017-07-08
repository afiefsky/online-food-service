<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTariffDistanceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tariff_distance', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('distance');
            $table->bigInteger('price');
            $table->boolean('is_valid');
            $table->timestamps();
            $table->dateTime('invalid_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Schema::dropIfExists('tariff_distance');
    }
}
