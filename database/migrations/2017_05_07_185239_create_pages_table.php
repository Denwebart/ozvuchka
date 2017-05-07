<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
	    Schema::create('pages', function (Blueprint $table) {
		    $table->increments('id');
		    $table->integer('parent_id')->default(0);
		    $table->integer('user_id');
		    $table->tinyInteger('type')->default(1);
		    $table->string('alias', 300);
		    $table->boolean('is_published')->default(0);
		    $table->boolean('is_container')->default(0);
		    $table->string('title', 500);
		    $table->string('menu_title', 100);
		    $table->string('image', 300);
		    $table->string('image_alt', 1000);
		    $table->text('introtext');
		    $table->text('content');
		    $table->timestamps();
		    $table->timestamp('published_at')->nullable();
		    $table->string('meta_title', 600);
		    $table->string('meta_desc', 800);
		    $table->string('meta_key', 800);
	    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
	    Schema::dropIfExists('pages');
    }
}
