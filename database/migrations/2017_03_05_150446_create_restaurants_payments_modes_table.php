<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRestaurantsPaymentsModesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('restaurants_payments_modes', function(Blueprint $table)
        {
            $table->integer('restaurant_id')->unsigned();
            $table->integer('payment_mode_id')->unsigned();
            $table->primary(['restaurant_id', 'payment_mode_id']);
            $table->foreign('restaurant_id')->on('restaurants')->references('id');
            $table->foreign('payment_mode_id')->on('payments_modes')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('restaurants_payments_modes');
    }
}
