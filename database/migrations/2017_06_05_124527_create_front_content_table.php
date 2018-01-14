<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFrontContentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('front_contents', function (Blueprint $table) {
			$table->increments('id');
            $table->string('blurb');
            $table->string('subBlurb');
            $table->string('catchPhrase1');
            $table->string('catchPhrase2');
            $table->string('catchPhrase3');
            $table->string('descTitle');
            $table->text('descText');
			$table->string('title_1');
			$table->string('text_1');
			$table->string('title_2');
			$table->string('text_2');
			$table->string('title_3');
			$table->string('text_3');
			$table->string('rank_1');
			$table->string('rank_2');
			$table->string('rank_3');
			$table->string('new_1');
			$table->string('new_2');
			$table->string('new_3');
			$table->string('radius');
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
        Schema::dropIfExists('front_contents');
    }
}
