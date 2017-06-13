<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FillSettingsTableMetatags extends Migration
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
				'key' => 'meta.robots',
				'category' => \App\Models\Setting::CATEGORY_SITE,
				'type' => \App\Models\Setting::TYPE_STRING,
				'title' => 'Мета-тег Robots',
				'description' => "Указывает поисковым роботам,
								можно ли индексировать данную страницу
								и можно ли использовать ссылки, приведенные на странице.<br>
								Если значение не активно или пусто - сайт выключен для индексирования.",
				'value' => 'noindex,nofollow',
				'is_active' => 1,
				'validation_rule' => 'max:255',
			],
			[
				'key' => 'meta.author',
				'category' => \App\Models\Setting::CATEGORY_SITE,
				'type' => \App\Models\Setting::TYPE_STRING,
				'title' => 'Мета-тег Author',
				'description' => "Служит для идентификации автора или принадлежности документа.<br>
								Может содержать имя автора сайта.<br>
								Как правило, не использутся вместе с мета-тегом Copyright.",
				'value' => '',
				'is_active' => 0,
				'validation_rule' => 'max:255',
			],
			[
				'key' => 'meta.copyright',
				'category' => \App\Models\Setting::CATEGORY_SITE,
				'type' => \App\Models\Setting::TYPE_STRING,
				'title' => 'Мета-тег Copyright',
				'description' => "Служит для идентификации автора или принадлежности документа. <br>
								Может содержать название организации или авторские права.
								Если сайт принадлежит какой-либо организации,
								целесообразнее использовать тег Copyright. <br>
								Как правило, не использутся вместе с мета-тегом Author.",
				'value' => '',
				'is_active' => 0,
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
			'meta.robots',
			'meta.author',
			'meta.copyright',
		])->delete();
	}
}
