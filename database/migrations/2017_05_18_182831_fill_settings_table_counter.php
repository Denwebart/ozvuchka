<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FillSettingsTableCounter extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
	public function up()
	{
		DB::table('settings')->insert([
			[
				'key' => 'counter',
				'category' => \App\Models\Setting::CATEGORY_SITE,
				'type' => \App\Models\Setting::TYPE_TEXT,
				'title' => 'Счетчик',
				'description' => 'Код счетчика посетителей.',
				'value' => '',
				'validation_rule' => '',
				'is_active' => \App\Models\Setting::INACTIVE,
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
		DB::table('settings')->whereIn('key', [
			'counter',
		])->delete();
	}
}
