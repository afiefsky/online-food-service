<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('customer_id')->unsigned();
            $table->foreign('customer_id')->references('id')->on('users_customers');

            $table->integer('courier_id')->unsigned();
            $table->foreign('courier_id')->references('id')->on('users_couriers');

            $table->bigInteger('distance_took');

            $table->integer('tariff_distance_id')->unsigned();
            $table->foreign('tariff_distance_id')->references('id')->on('tariff_distance');

            // 0 = is cancelled, 1 = is delivered, 2 = on delivery
            $table->enum('delivery_status', ['0', '1', '2'])->nullable();
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
        Schema::dropIfExists('orders');
    }
}
