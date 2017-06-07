<?php
/**
 * Class Slider
 *
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
 */

namespace App\Widgets\Slider;

class Slider
{
	public function show()
	{
		$items = \Cache::rememberForever('widgets.slider', function() {
			return \App\Models\Slider::whereIsPublished(1)->whereNotNull('image')->get();
		});
		
		return view('widget.slider::index', compact('items'))->render();
	}
}