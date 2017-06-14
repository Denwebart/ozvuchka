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
	public $title = 'Фотогалерея';
	public $description = 'Фотографии с нами';
	
	public function show($limit = 8)
	{
		return \Cache::rememberForever('widgets.gallery', function() use($limit) {
			
			$items = \App\Models\Gallery::select(['id', 'image', 'image_alt', 'title', 'description'])
				->published()
				->limit($limit)
				->get();
			
			return view('widget.gallery::index', compact('items'))
				->with('title', $this->title)->with('description', $this->description)->render();
		});
	}
}