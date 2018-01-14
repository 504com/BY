<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkhoursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workhours', function (Blueprint $table) {
             $table->increments('id');
             $table->integer('day_id')->unsigned();
             $table->foreign('day_id')->on('days')->references('id');
             $table->time('start');
             $table->time('end');
             $table->integer('restaurant_id')->unsigned();
             $table->foreign('restaurant_id')->on('restaurants')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('workhours');
    }
}
