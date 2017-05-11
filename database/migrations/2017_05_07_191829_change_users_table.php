<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
	public function up()
	{
		Schema::table('users', function (Blueprint $table) {
			$table->renameColumn('name', 'login');
			$table->tinyInteger('role')->default(0)->after('id');
			$table->boolean('is_active')->default(0)->after('email');
			$table->string('avatar')->nullable()->after('is_active');
			$table->string('firstname', 100)->nullable()->after('avatar');
			$table->string('lastname', 100)->nullable()->after('firstname');
			$table->text('description')->after('lastname');
			$table->string('activation_code');
		});
	}
	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('users', function (Blueprint $table) {
			$table->renameColumn('login', 'name');
			$table->dropColumn('role');
			$table->dropColumn('is_active');
			$table->dropColumn('avatar');
			$table->dropColumn('firstname');
			$table->dropColumn('lastname');
			$table->dropColumn('description');
			$table->dropColumn('activation_code');
		});
	}
}
