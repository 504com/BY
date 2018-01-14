<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function(Blueprint $table)
        {
            $table->increments('id');
            $table->dateTime('start');
            $table->dateTime('end');
            $table->timestamps();
            $table->tinyInteger('guests');
            $table->string('organizer');
            $table->string('phone');
			$table->string('details');
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
        Schema::dropIfExists('bookings');
    }
}
