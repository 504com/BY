<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRestaurantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('restaurants', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('name', 100)->unique();
            $table->string('slug', 100)->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('flash', 50);
            $table->string('description');
            $table->double('latitude');
            $table->double('longitude');
            $table->string('address', 100);
            $table->string('city', 60);
            $table->char('zipcode', 5);
			$table->string('phone');
            $table->string('picture', 100);
            $table->string('capacity')->default(30);
            $table->float('booking_duration')->default(2);
			$table->rememberToken();
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
        Schema::drop('restaurants');
    }
}
