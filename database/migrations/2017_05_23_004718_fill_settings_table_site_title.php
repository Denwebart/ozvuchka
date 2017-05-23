<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FillSettingsTableSiteTitle extends Migration
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
				'key' => 'siteTitle',
				'category' => \App\Models\Setting::CATEGORY_SITE,
				'type' => \App\Models\Setting::TYPE_TEXT,
				'title' => 'Заголовок сайта',
				'description' => '',
				'value' => '',
				'validation_rule' => 'max:255',
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
			'siteTitle',
		])->delete();
	}
}
