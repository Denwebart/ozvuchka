<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
	    Schema::create('menus', function (Blueprint $table) {
		    $table->increments('id');
		    $table->tinyInteger('type')->default(1);
		    $table->integer('page_id');
		    $table->integer('parent_id')->default(0);
		    $table->integer('position')->default(0);
	    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
	    Schema::drop('menus');
    }
}