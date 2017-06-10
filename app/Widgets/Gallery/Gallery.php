<?php
/**
 * Class Gallery
 *
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
 */


namespace App\Widgets\Gallery;

class Gallery
{
	public function show()
	{
		return \Cache::rememberForever('widgets.gallery', function() {
			$title = 'Фотогалерея';
			$description = 'Фотографии с нами';
			
			$items = \App\Models\Gallery::select(['id', 'image', 'image_alt', 'title', 'description'])
				->published()
				->limit(8)
				->get();
			
			return \View::make('widget.gallery::index', compact('items', 'title', 'description'))->render();
		});
	}
}