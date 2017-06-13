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
	public $title = 'Отзывы о нас';
	public $description = false;
	
	public function vertical($limit = 3)
	{
		return \Cache::rememberForever('widgets.reviews.vertical', function() use($limit) {
			
			$items = Review::select(['id', 'user_name', 'user_email', 'user_avatar', 'text', 'published_at'])
				->published()
				->orderBy('position', 'ASC')
				->limit($limit)
				->get();
			
			return view('widget.reviews::vertical', compact('items'))
				->with('title', $this->title)->with('description', $this->description)->render();
		});
	}
}