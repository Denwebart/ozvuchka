<?php
/**
 * Class MenusController
 *
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
 */

namespace Modules\Admin\Controllers;

use App\Models\Menu;
use App\Models\Page;
use Illuminate\Http\Request;

class MenusController extends Controller
{
	/**
	 * Rename menu item
	 *
	 * @param Request $request
	 * @return \Illuminate\Http\JsonResponse
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function rename(Request $request)
	{
		// доделать изменение заголовка меню для других пунктов меню (в других меню)
		if($request->ajax()) {
			$menu = Menu::find($request->get('pk'));

			if($menu && $menu->page) {
				$newMenuTitle = trim($request->get('value'));
				$validator = \Validator::make(['menu_title' => $newMenuTitle], ['menu_title' => 'required|max:50']);
				if($validator->fails()) {
					return \Response::json([
						'success' => false,
						'message' => 'Произошла ошибка, заголовок меню не изменен. Исправьте ошибки.',
						'error' => $validator->errors()->first('menu_title'),
					]);
				}

				$menu->page->menu_title = $newMenuTitle;
				$menu->page->save();
				
				\Cache::forget('menuItems');

				return \Response::json([
					'success' => true,
					'message' => 'Заголовок меню успешно изменен.',
					'pageId' => $menu->page->id,
				]);
			}

			return \Response::json([
				'success' => false,
				'message' => 'Произошла ошибка, заголовок меню не изменен.'
			]);
		}
	}

	/**
	 * Delete menu item
	 *
	 * @param Request $request
	 * @return \Illuminate\Http\JsonResponse
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function delete(Request $request)
	{
		if($request->ajax()) {
			$menu = Menu::whereId($request->get('itemId'))
				->whereType($request->get('menuType'))
				->first();

			if(is_object($menu) && $menu->delete()) {

				$items = Menu::getMenuItems($request->get('menuType'));
				
				\Cache::forget('menuItems');
				
				return \Response::json([
					'success' => true,
					'message' => 'Пункт меню успешно удалён.',
					'menuItemsHtml' => view('admin::menus.items', compact('items'))
						->with('menuType', $request->get('menuType'))->render(),
				]);
			}

			return \Response::json([
				'success' => false,
				'message' => 'Произошла ошибка, пункт меню не удалён'
			]);
		}
	}

	/**
	 * Change position of menu items
	 *
	 * @param Request $request
	 * @return mixed
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function changePosition(Request $request)
	{
		$positions = $request->get('positions');
		$i = 0;
		foreach($positions as $itemId) {
			$menu = Menu::find($itemId);
			$menu->position = $i;
			$menu->save();
			$i++;
		}
		
		\Cache::forget('menuItems');

		return \Response::json(array(
			'success' => true,
			'message' => 'Позиция пункта меню изменена.',
		));
	}

	/**
	 * Autocomplete pages for adding to menus
	 * (with jQuery-Autocomplete https://github.com/devbridge/jQuery-Autocomplete)
	 *
	 * @param Request $request
	 * @return mixed
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function pagesAutocomplete(Request $request) {
		$query = $request->get('query');
		$pages = Page::where('title', 'like', "%$query%")
			->orWhere('menu_title', 'like', "%$query%")
			->get(['id', 'title', 'menu_title']);
		$result = ['query' => "Unit", 'suggestions' => []];
		foreach($pages as $item) {
			$title = ($item->menu_title && $item->title)
				? $item->menu_title . ' (' . $item->title . ')'
				: $item->getTitle();
			$result['suggestions'][] = [
				'value' => $title, 'data' => $item->id
			];
		}
		
		return \Response::json($result);
	}

	/**
	 * Add new menu item
	 *
	 * @param Request $request
	 * @return \Illuminate\Http\JsonResponse
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function add(Request $request)
	{
		if($request->ajax()) {

			if(!$request->get('pageId') || (!$request->get('pageTitle') && empty($request->get('pageTitle')))) {
				return \Response::json([
					'success' => false,
					'message' => 'Пункт меню не добавлен. Выберите страницу, которую хотите добавить.'
				]);
			}

			$page = Page::whereId($request->get('pageId'))
				->orWhere('title', '=', $request->get('pageTitle'))
				->orWhere('menu_title', '=', $request->get('pageTitle'))
				->first();

			if(!$page) {
				return \Response::json([
					'success' => false,
					'message' => 'Пункт меню не добавлен. Страница, которую вы хотите добавить, не существует.'
				]);
			}

			$menu = Menu::whereType($request->get('menuType'))->wherePageId($page->id)->first();
			if($menu) {
				return \Response::json([
					'success' => false,
					'message' => 'Такой пункт меню уже добавлен в меню "' . Menu::$types[$request->get('menuType')] . '".'
				]);
			}

			$menuItem = new Menu();
			$menuItem->type = $request->get('menuType');
			$menuItem->page_id = $page->id;

			if($menuItem->save()) {
				$items = Menu::getMenuItems($request->get('menuType'));
				
				\Cache::forget('menuItems');
				
				return \Response::json([
					'success' => true,
					'message' => 'Пункт меню успешно добавлен.',
					'menuItemsHtml' => view('admin::menus.items', compact('items'))
						->with('menuType', $request->get('menuType'))->render(),
				]);
			}
		}
	}
}
