<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FillSettingsTableCodeTopCodeBottom extends Migration
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
			    'key' => 'code.head',
			    'category' => \App\Models\Setting::CATEGORY_SITE,
			    'type' => \App\Models\Setting::TYPE_TEXT,
			    'title' => 'HTML в <head>',
			    'description' => "HTML код перед закрывающимся тегом </head>. \n Используется для вставки кода счетчика посещаемости (Google Analytics или Yandex.Метрика).",
			    'value' => null,
			    'is_active' => 0,
			    'validation_rule' => '',
		    ],
		    [
			    'key' => 'code.body',
			    'category' => \App\Models\Setting::CATEGORY_SITE,
			    'type' => \App\Models\Setting::TYPE_TEXT,
			    'title' => 'HTML в <body>',
			    'description' => "HTML код после открывающегося тега <body>. \n Используется для вставки кода комментариев с Facebook.",
			    'value' => null,
			    'is_active' => 0,
			    'validation_rule' => '',
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
		    'code.head',
		    'code.body',
	    ])->delete();
    }
}
