<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangePagesTableMakeFieldsNullable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
	    Schema::table('pages', function (Blueprint $table) {
		    $table->string('title', 500)->nullable()->change();
		    $table->string('menu_title', 100)->nullable()->change();
		    $table->string('image', 300)->nullable()->change();
		    $table->string('image_alt', 1000)->nullable()->change();
		    $table->text('introtext')->nullable()->change();
		    $table->text('content')->nullable()->change();
		    $table->string('meta_title', 600)->nullable()->change();
		    $table->string('meta_desc', 800)->nullable()->change();
		    $table->string('meta_key', 800)->nullable()->change();
	    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
	    Schema::table('pages', function (Blueprint $table) {
		    $table->string('title', 500)->change();
		    $table->string('menu_title', 100)->change();
		    $table->string('image', 300)->change();
		    $table->string('image_alt', 1000)->change();
		    $table->text('introtext')->change();
		    $table->text('content')->change();
		    $table->string('meta_title', 600)->change();
		    $table->string('meta_desc', 800)->change();
		    $table->string('meta_key', 800)->change();
	    });
    }
}
