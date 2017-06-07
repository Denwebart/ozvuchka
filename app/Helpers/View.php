<?php
/**
 * Class View
 *
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
 */

namespace App\Helpers;

class View
{
	/**
	 * Get pages branch for sitemap
	 *
	 * @param object $model
	 * @param string $url
	 * @param int $level
	 * @param null $view
	 * @return mixed
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
	 */
	public static function getChildrenPages($model, $url, $level = 1, $view = null)
	{
		// доделать: оптимизировать количество запросов, возможно выбирать одним запросом?
		// доделать: вывод пунктов (убрать html)
		if($model->is_container) {
			$children = \Cache::rememberForever('sitemapItems.children-' . $model->id, function() use($model) {
				return $model->children()->published()
					->get(['id', 'parent_id', 'user_id', 'type', 'is_container', 'alias', 'title', 'menu_title', 'updated_at', 'published_at']);
			});
			
			if(!$view) {
				if(count($children)) {
					echo '<ul class="level-' . $level . '">';
					++$level;
					foreach ($children as $item) {
						echo '<li>';
						echo \View::make('parts.sitemapListItem', compact('item', 'level'))->with('url', $url . '/' . $item->alias)->render();
						if ($item->is_container && count($model->children()->published()->get())) {
							self::getChildrenPages($item, $url . '/' . $item->alias, $level);
						}
						echo '</li>';
					}
					echo '</ul>';
				}
			} elseif($view == 'xml') {
				if(count($children)) {
					++$level;
					foreach ($children as $item) {
						echo \View::make('parts.sitemapXmlItem', compact('item', 'level'))->with('url', $url . '/' . $item->alias)->render();
						if ($item->is_container && count($model->children()->published()->get())) {
							self::getChildrenPages($item, $url . '/' . $item->alias, $level, 'xml');
						}
					}
				}
			}
			
			return false;
		}
	}
}