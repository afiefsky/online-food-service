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

            $table->integer('courier_id')->unsigned()->nullable();
            $table->foreign('courier_id')->references('id')->on('users_couriers');

            $table->integer('meal_id')->unsigned();
            $table->foreign('meal_id')->references('id')->on('meals')->nullable();

            $table->integer('qty');

            $table->bigInteger('tariff')->nullable();

            $table->text('notes')->nullable();

//            $table->integer('tariff_distance_id')->unsigned();
//            $table->foreign('tariff_distance_id')->references('id')->on('tariff_distance');

            // 0 = on delivery, 1 = is delivered, 2 = is cancelled
            $table->enum('delivery_status', ['0', '1', '2'])->nullable();
            $table->bigInteger('total')->nullable();
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
