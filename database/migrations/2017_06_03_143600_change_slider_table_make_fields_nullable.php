<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeSliderTableMakeFieldsNullable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
	public function up()
	{
		Schema::table('slider', function (Blueprint $table) {
			$table->string('image')->nullable()->change();
			$table->string('button_link')->nullable()->change();
		});
	}
	
	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('slider', function (Blueprint $table) {
			$table->string('image')->change();
			$table->string('button_link')->change();
		});
	}
}
