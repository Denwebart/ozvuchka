<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeGalleryTableMakeFieldsNullable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
	    Schema::table('gallery', function (Blueprint $table) {
		    $table->string('title')->nullable()->change();
		    $table->string('description', 1000)->nullable()->change();
	    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
	    Schema::table('gallery', function (Blueprint $table) {
		    $table->string('title')->change();
		    $table->string('description', 1000)->change();
	    });
    }
}
