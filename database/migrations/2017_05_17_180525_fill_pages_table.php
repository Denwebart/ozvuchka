<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FillPagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
	public function up()
	{
		DB::table('pages')->insert(
			[
				[
					'id' => 1,
					'alias' => '/',
					'user_id' => '1',
					'type' => \App\Models\Page::TYPE_SYSTEM_PAGE,
					'title' => 'Главная страница',
					'menu_title' => 'Главная',
					'is_published' => \App\Models\Page::PUBLISHED,
					'created_at' => \Carbon\Carbon::now(),
					'published_at' => \Carbon\Carbon::now(),
				],
				[
					'id' => 2,
					'alias' => 'kontakty',
					'user_id' => '1',
					'type' => \App\Models\Page::TYPE_SYSTEM_PAGE,
					'title' => 'Контакты',
					'menu_title' => 'Контакты',
					'is_published' => \App\Models\Page::PUBLISHED,
					'created_at' => \Carbon\Carbon::now(),
					'published_at' => \Carbon\Carbon::now(),
				],
				[
					'id' => 3,
					'alias' => 'karta-sajta',
					'user_id' => '1',
					'type' => \App\Models\Page::TYPE_SYSTEM_PAGE,
					'title' => 'Карта сайта',
					'menu_title' => 'Карта сайта',
					'is_published' => \App\Models\Page::PUBLISHED,
					'created_at' => \Carbon\Carbon::now(),
					'published_at' => \Carbon\Carbon::now(),
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
		DB::table('pages')
			->whereIn('id', [1, 2, 3])
			->delete();
	}
}
