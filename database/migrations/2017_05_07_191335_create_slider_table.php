<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSliderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
	    Schema::create('slider', function (Blueprint $table) {
		    $table->increments('id');
		    $table->string('image');
		    $table->string('image_alt', 700)->nullable();
		    $table->boolean('is_published')->default(1);
		    $table->string('title')->nullable();
		    $table->string('text')->nullable();
		    $table->string('button_text', 100)->nullable();
		    $table->string('button_link');
	    });
	}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
	    Schema::drop('slider');
    }
}
