<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRestaurantsServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('restaurants_services', function(Blueprint $table)
        {
            $table->integer('restaurant_id')->unsigned();
            $table->integer('service_id')->unsigned();
            $table->primary(['restaurant_id', 'service_id']);
            $table->foreign('restaurant_id')->on('restaurants')->references('id');
            $table->foreign('service_id')->on('services')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('restaurants_services');
    }
}
