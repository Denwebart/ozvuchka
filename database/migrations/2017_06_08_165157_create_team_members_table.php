<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeamMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
	    Schema::create('team_members', function (Blueprint $table) {
		    $table->increments('id');
		    $table->string('name', 255)->nullable();
		    $table->string('description', 1000)->nullable();
		    $table->string('image', 100)->nullable();
		    $table->string('image_alt', 255)->nullable();
		    $table->integer('position')->default(0);
		    $table->boolean('is_published')->default(1);
		    $table->string('link_vk', 255)->nullable();
		    $table->string('link_fb', 255)->nullable();
		    $table->string('link_instagram', 255)->nullable();
		    $table->string('link_twitter', 255)->nullable();
		    $table->string('link_google', 255)->nullable();
		    $table->string('link_youtube', 255)->nullable();
		    $table->timestamps();
	    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
	    Schema::dropIfExists('team_members');
    }
}
