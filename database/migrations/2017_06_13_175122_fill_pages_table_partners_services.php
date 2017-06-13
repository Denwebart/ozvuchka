<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FillPagesTablePartnersServices extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
	public function up()
	{
		\App\Models\Page::whereIn('id', [3, 4, 5, 6, 7, 8])->delete();
		\App\Models\Page::whereIn('alias', [
			\App\Helpers\Translit::make('Услуги'),
			\App\Helpers\Translit::make('Партнеры'),
		])->delete();
		
		DB::table('pages')->insert(
			[
				[
					'id' => 3,
					'alias' => \App\Helpers\Translit::make('Услуги'),
					'user_id' => '1',
					'type' => \App\Models\Page::TYPE_SYSTEM_PAGE,
					'title' => 'Услуги',
					'menu_title' => 'Услуги',
					'is_container' => 1,
					'is_published' => \App\Models\Page::PUBLISHED,
					'created_at' => \Carbon\Carbon::now(),
					'published_at' => \Carbon\Carbon::now(),
				],
				[
					'id' => 4,
					'alias' => \App\Helpers\Translit::make('Новости'),
					'user_id' => '1',
					'type' => \App\Models\Page::TYPE_SYSTEM_PAGE,
					'title' => 'Новости',
					'menu_title' => 'Новости',
					'is_container' => 1,
					'is_published' => \App\Models\Page::PUBLISHED,
					'created_at' => \Carbon\Carbon::now(),
					'published_at' => \Carbon\Carbon::now(),
				],
				[
					'id' => 5,
					'alias' => \App\Helpers\Translit::make('Партнеры'),
					'user_id' => '1',
					'type' => \App\Models\Page::TYPE_SYSTEM_PAGE,
					'title' => 'Партнеры',
					'menu_title' => 'Партнеры',
					'is_container' => 0,
					'is_published' => \App\Models\Page::PUBLISHED,
					'created_at' => \Carbon\Carbon::now(),
					'published_at' => \Carbon\Carbon::now(),
				],
				[
					'id' => 6,
					'alias' => \App\Helpers\Translit::make('Галерея'),
					'user_id' => '1',
					'type' => \App\Models\Page::TYPE_SYSTEM_PAGE,
					'title' => 'Галерея',
					'menu_title' => 'Галерея',
					'is_container' => 0,
					'is_published' => \App\Models\Page::PUBLISHED,
					'created_at' => \Carbon\Carbon::now(),
					'published_at' => \Carbon\Carbon::now(),
				],
				[
					'id' => 7,
					'alias' => \App\Helpers\Translit::make('Контакты'),
					'user_id' => '1',
					'type' => \App\Models\Page::TYPE_SYSTEM_PAGE,
					'title' => 'Контакты',
					'menu_title' => 'Контакты',
					'is_container' => 0,
					'is_published' => \App\Models\Page::PUBLISHED,
					'created_at' => \Carbon\Carbon::now(),
					'published_at' => \Carbon\Carbon::now(),
				],
				[
					'id' => 8,
					'alias' => \App\Helpers\Translit::make('Карта сайта'),
					'user_id' => '1',
					'type' => \App\Models\Page::TYPE_SYSTEM_PAGE,
					'title' => 'Карта сайта',
					'menu_title' => 'Карта сайта',
					'is_container' => 0,
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
			->whereIn('id', [3, 4, 5, 6, 7, 8])
			->delete();
		
		DB::table('pages')->insert(
			[
				[
					'id' => 3,
					'alias' => \App\Helpers\Translit::make('Новости'),
					'user_id' => '1',
					'type' => \App\Models\Page::TYPE_SYSTEM_PAGE,
					'title' => 'Новости',
					'menu_title' => 'Новости',
					'is_container' => 1,
					'is_published' => \App\Models\Page::PUBLISHED,
					'created_at' => \Carbon\Carbon::now(),
					'published_at' => \Carbon\Carbon::now(),
				],
				[
					'id' => 4,
					'alias' => \App\Helpers\Translit::make('Галерея'),
					'user_id' => '1',
					'type' => \App\Models\Page::TYPE_SYSTEM_PAGE,
					'title' => 'Галерея',
					'menu_title' => 'Галерея',
					'is_container' => 0,
					'is_published' => \App\Models\Page::PUBLISHED,
					'created_at' => \Carbon\Carbon::now(),
					'published_at' => \Carbon\Carbon::now(),
				],
				[
					'id' => 5,
					'alias' => \App\Helpers\Translit::make('Контакты'),
					'user_id' => '1',
					'type' => \App\Models\Page::TYPE_SYSTEM_PAGE,
					'title' => 'Контакты',
					'menu_title' => 'Контакты',
					'is_container' => 0,
					'is_published' => \App\Models\Page::PUBLISHED,
					'created_at' => \Carbon\Carbon::now(),
					'published_at' => \Carbon\Carbon::now(),
				],
				[
					'id' => 6,
					'alias' => \App\Helpers\Translit::make('Карта сайта'),
					'user_id' => '1',
					'type' => \App\Models\Page::TYPE_SYSTEM_PAGE,
					'title' => 'Карта сайта',
					'menu_title' => 'Карта сайта',
					'is_container' => 0,
					'is_published' => \App\Models\Page::PUBLISHED,
					'created_at' => \Carbon\Carbon::now(),
					'published_at' => \Carbon\Carbon::now(),
				],
			]);
	}
}
