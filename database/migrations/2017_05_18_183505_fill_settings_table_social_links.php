<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FillSettingsTableSocialLinks extends Migration
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
				'key' => 'socialLinks.vk',
				'category' => \App\Models\Setting::CATEGORY_SITE,
				'type' => \App\Models\Setting::TYPE_TEXT,
				'title' => 'ВКонтакте',
				'description' => 'Ссылка на страницу/группу/сообщество.',
				'value' => '',
				'validation_rule' => 'url|max:255',
			],
			[
				'key' => 'socialLinks.facebook',
				'category' => \App\Models\Setting::CATEGORY_SITE,
				'type' => \App\Models\Setting::TYPE_TEXT,
				'title' => 'Facebook',
				'description' => 'Ссылка на страницу/группу/сообщество.',
				'value' => '',
				'validation_rule' => 'url|max:255',
			],
			[
				'key' => 'socialLinks.instagram',
				'category' => \App\Models\Setting::CATEGORY_SITE,
				'type' => \App\Models\Setting::TYPE_TEXT,
				'title' => 'Instagram',
				'description' => 'Ссылка на страницу/группу/сообщество.',
				'value' => '',
				'validation_rule' => 'url|max:255',
			],
			[
				'key' => 'socialLinks.twitter',
				'category' => \App\Models\Setting::CATEGORY_SITE,
				'type' => \App\Models\Setting::TYPE_TEXT,
				'title' => 'Twitter',
				'description' => 'Ссылка на страницу/группу/сообщество.',
				'value' => '',
				'validation_rule' => 'url|max:255',
			],
			[
				'key' => 'socialLinks.odnoklassniki',
				'category' => \App\Models\Setting::CATEGORY_SITE,
				'type' => \App\Models\Setting::TYPE_TEXT,
				'title' => 'Одноклассники',
				'description' => 'Ссылка на страницу/группу/сообщество.',
				'value' => '',
				'validation_rule' => 'url|max:255',
			],
			[
				'key' => 'socialLinks.google',
				'category' => \App\Models\Setting::CATEGORY_SITE,
				'type' => \App\Models\Setting::TYPE_TEXT,
				'title' => 'Google+',
				'description' => 'Ссылка на страницу/группу/сообщество.',
				'value' => '',
				'validation_rule' => 'url|max:255',
			],
			[
				'key' => 'socialLinks.youtube',
				'category' => \App\Models\Setting::CATEGORY_SITE,
				'type' => \App\Models\Setting::TYPE_TEXT,
				'title' => 'YouTube',
				'description' => 'Ссылка на страницу/группу/сообщество.',
				'value' => '',
				'validation_rule' => 'url|max:255',
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
			'socialLinks.vk',
			'socialLinks.facebook',
			'socialLinks.instagram',
			'socialLinks.twitter',
			'socialLinks.odnoklassniki',
			'socialLinks.google',
			'socialLinks.youtube',
		])->delete();
	}
}
