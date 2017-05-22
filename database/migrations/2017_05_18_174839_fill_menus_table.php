<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FillMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
	public function up()
	{
		DB::table('menus')->insert(
			[
				[
					'id' => 1,
					'type' => \App\Models\Menu::TYPE_MAIN,
					'page_id' => \App\Models\Page::whereAlias('/')->first()->id,
					'position' => '1',
				],
				[
					'id' => 2,
					'type' => \App\Models\Menu::TYPE_MAIN,
					'page_id' => \App\Models\Page::ID_CONTACT_PAGE,
					'position' => '2',
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
		DB::table('menus')->whereIn('id', [1, 2])->delete();
	}
}
