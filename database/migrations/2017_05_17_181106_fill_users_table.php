<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FillUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
	    DB::table('users')->insert(
		    [
			    [
			    	'id' => 1,
				    'role' => \App\Models\User::ROLE_ADMIN,
				    'login' => 'Admin',
				    'email' => 'admin@email.com',
				    'password' => bcrypt('111111'),
				    'remember_token' => 'remember_token'
			    ],
		    ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
	    DB::table('users')
		    ->where('id', 1)
		    ->delete();
    }
}
