<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLinkWebsiteFieldIntoPartnersAndTeamMembersTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
	public function up()
	{
		Schema::table('team_members', function (Blueprint $table) {
			$table->string('link_website', 255)->nullable()->after('is_published');
		});
		Schema::table('partners', function (Blueprint $table) {
			$table->string('link_website', 255)->nullable()->after('is_published');
		});
	}
	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('team_members', function (Blueprint $table) {
			$table->dropColumn('link_website');
		});
		Schema::table('partners', function (Blueprint $table) {
			$table->dropColumn('link_website');
		});
	}
}
