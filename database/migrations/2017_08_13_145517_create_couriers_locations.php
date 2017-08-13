<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCouriersLocations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('couriers_locations', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('courier_id')->unsigned();
            $table->foreign('courier_id')->references('id')->on('courier');

            $table->decimal('latitude', 18, 15);
            $table->decimal('longitude', 18, 15);

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
        Schema::dropIfExists('couriers_locations');
    }
}
