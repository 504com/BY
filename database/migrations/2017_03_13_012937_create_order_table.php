<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('customer_id')->unsigned();
            $table->foreign('customer_id')->on('users')->references('id');
            $table->integer('restaurant_id')->unsigned();
            $table->foreign('restaurant_id')->on('restaurants')->references('id');
            $table->dateTime('order_date');
            $table->integer('service_id')->unsigned();
            $table->foreign('service_id')->on('services')->references('id');
            $table->timestamps();
            $table->string('details')->nullable();
        });

        Schema::table('bookings', function(Blueprint $table)
        {
            $table->integer('order_id')->unsigned()->nullable();
            $table->foreign('order_id')->on('orders')->references('id')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bookings');
        Schema::drop('orders');
    }
}
