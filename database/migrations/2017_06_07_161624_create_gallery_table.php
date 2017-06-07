<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGalleryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
	    Schema::create('gallery', function (Blueprint $table) {
		    $table->increments('id');
		    $table->string('image', 255);
		    $table->string('image_alt', 255)->nullable();
		    $table->string('title', 255);
		    $table->string('description', 1000);
		    $table->boolean('is_published')->default(1);
		    $table->timestamps();
		    $table->timestamp('published_at')->nullable();
	    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
	    Schema::dropIfExists('gallery');
    }
}
