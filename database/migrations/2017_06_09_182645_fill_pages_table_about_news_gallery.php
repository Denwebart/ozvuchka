<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FillPagesTableAboutNewsGallery extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    	\App\Models\Page::whereIn('id', [2, 3, 4, 5, 6])->delete();
    	
	    DB::table('pages')->insert(
		    [
			    [
				    'id' => 2,
				    'alias' => \App\Helpers\Translit::make('О нас'),
				    'user_id' => '1',
				    'type' => \App\Models\Page::TYPE_SYSTEM_PAGE,
				    'title' => 'О нас',
				    'menu_title' => 'О нас',
				    'is_published' => \App\Models\Page::PUBLISHED,
				    'created_at' => \Carbon\Carbon::now(),
				    'published_at' => \Carbon\Carbon::now(),
			    ],
			    [
				    'id' => 3,
				    'alias' => \App\Helpers\Translit::make('Новости'),
				    'user_id' => '1',
				    'type' => \App\Models\Page::TYPE_SYSTEM_PAGE,
				    'title' => 'Новости',
				    'menu_title' => 'Новости',
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
		    ->whereIn('id', [2, 3, 4, 5, 6])
		    ->delete();
	
	    DB::table('pages')->insert(
		    [
			    [
				    'id' => 2,
				    'alias' => \App\Helpers\Translit::make('Контакты'),
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
				    'alias' => \App\Helpers\Translit::make('Карта сайта'),
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
}
