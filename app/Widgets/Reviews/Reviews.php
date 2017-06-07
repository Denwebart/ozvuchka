<?php
/**
 * Class Reviews
 *
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
 */


namespace App\Widgets\Reviews;

use App\Models\Review;

class Reviews
{
	public function show()
	{
		return \Cache::rememberForever('widgets.reviews', function() {
			$title = 'Отзывы о магазине';
			
			$items = Review::select(['id', 'user_name', 'user_email', 'user_avatar', 'text'])
				->limit(4)
				->whereIsPublished(1)
				->orderBy('published_at', 'DESC')
				->get();
			
			return \View::make('widget.reviews::index', compact('items', 'title'))->render();
		});
	}
}