<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameColumnLinkFbInTeamMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
	    Schema::table('team_members', function (Blueprint $table) {
		    $table->renameColumn('link_fb', 'link_facebook');
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
		    $table->renameColumn('link_facebook', 'link_fb');
	    });
    }
}
