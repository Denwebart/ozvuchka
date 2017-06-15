<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddVideoUrlFieldIntoGalleryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
	public function up()
	{
		Schema::table('gallery', function (Blueprint $table) {
			$table->string('video_url')->nullable()->after('image_alt');
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
			$table->dropColumn('video_url');
		});
	}
}
