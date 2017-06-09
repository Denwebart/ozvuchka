<?php
/**
 * Class Reviews
 *
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
 */


namespace App\Widgets\TeamMembers;

use App\Models\TeamMember;

class TeamMembers
{
	public function show()
	{
		return \Cache::rememberForever('widgets.teamMembers', function() {
			$title = 'Наша команда';
			
			$items = TeamMember::select(['id', 'name', 'description', 'image', 'image_alt', 'position', 'is_published', 'link_vk', 'link_fb', 'link_instagram', 'link_twitter', 'link_google', 'link_youtube'])
				->limit(4)
				->whereIsPublished(1)
				->orderBy('position', 'ASC')
				->get();
			
			return \View::make('widget.teamMembers::index', compact('items', 'title'))->render();
		});
	}
}