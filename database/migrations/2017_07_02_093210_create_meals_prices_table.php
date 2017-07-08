<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMealsPricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meals_prices', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('meal_id')->unsigned();
            $table->foreign('meal_id')->references('id')->on('meals');

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
        Schema::dropIfExists('meals_prices');
    }
}
