<?php
/**
 * Class News
 *
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
 */

namespace App\Widgets\News;

use App\Models\Page;

class News
{
	public $title = 'Новости';
	public $description = 'Недавние события';
	
	/**
	 * Latest News: vertical view
	 *
	 * @param int $limit
	 * @return mixed
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function vertical($limit = 3)
	{
		return \Cache::rememberForever('widgets.news.vertical', function() use($limit) {
			
			$items = $this->getItems($limit);
			
			return \View::make('widget.news::vertical', compact('items'))
				->with('title', $this->title)->with('description', $this->description)->render();
		});
	}
	
	/**
	 * Latest News: horizontal view
	 *
	 * @param int $limit
	 * @return mixed
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function horizontal($limit = 5)
	{
		return \Cache::rememberForever('widgets.news.horizontal', function() use($limit) {
			
			$items = $this->getItems($limit);
			
			return \View::make('widget.news::horizontal', compact('items'))
				->with('title', $this->title)->with('description', $this->description)->render();
		});
	}
	
	protected function getItems($limit) {
		// доделать рекурсивно, вынести в отдельный метод, повторяется в getCategoryPage
		$subcategories = \Cache::rememberForever('page.subcategories.' . Page::ID_NEWS_PAGE, function() {
			return Page::whereParentId(Page::ID_NEWS_PAGE)->whereIsContainer(1)
				->with([
					'parent' => function($q) {
						$q->select(['id', 'parent_id', 'user_id', 'type', 'alias', 'is_container', 'is_published', 'menu_title', 'title']);
					}
				])
				->get(['id', 'parent_id', 'user_id', 'type', 'alias', 'is_container', 'is_published', 'menu_title', 'title']);
		});
		$subcategoryIds = $subcategories->pluck('id');
		$subcategoryIds[] = Page::ID_NEWS_PAGE;
		
		return Page::select(['id', 'parent_id', 'user_id', 'alias', 'type', 'is_container', 'title', 'menu_title', 'is_published', 'published_at', 'introtext', 'content', 'image', 'image_alt'])
			->whereParentId($subcategoryIds)
			->published()
			->with([
				'parent' => function($q) {
					$q->select(['id', 'parent_id', 'user_id', 'type', 'alias', 'is_container', 'is_published', 'menu_title', 'title']);
				}
			])
			->orderBy('published_at', 'DESC')
			->limit($limit)
			->get();
	}
	
}