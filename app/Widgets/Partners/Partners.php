<?php
/**
 * Class Partners
 *
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
 */


namespace App\Widgets\Partners;

use App\Models\Partner;

class Partners
{
	public $title = 'Мы сотрудничаем';
	public $description = '';
	
	public function show()
	{
		return \Cache::rememberForever('widgets.partners', function() {
			
			$items = Partner::select(['id', 'title', 'description', 'image', 'image_alt', 'position', 'is_published', 'link_vk', 'link_facebook', 'link_instagram', 'link_twitter', 'link_google', 'link_youtube'])
				->published()
				->orderBy('position', 'ASC')
				->get();
			
			return view('widget.partners::index', compact('items'))
				->with('title', $this->title)->with('description', $this->description)->render();
		});
	}
}