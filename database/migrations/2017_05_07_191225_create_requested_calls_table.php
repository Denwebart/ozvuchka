<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequestedCallsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
	    Schema::create('requested_calls', function (Blueprint $table) {
		    $table->increments('id');
		    $table->integer('user_id')->nullable();
		    $table->string('name');
		    $table->string('phone');
		    $table->tinyInteger('status')->nullable();
		    $table->text('comment');
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
	    Schema::drop('requested_calls');
    }
}
