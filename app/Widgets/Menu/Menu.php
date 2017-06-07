<?php
/**
 * Class Menu
 *
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
 */

namespace App\Widgets\Menu;

class Menu
{
	private $menuItems = [];

	public function __construct()
	{
		$this->menuItems = \Cache::rememberForever('menuItems', function() {
			return \App\Models\Menu::getMenuItems();
		});
	}

	/**
	 * Get menu items
	 *
	 * @param $type
	 * @return array|mixed
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
	 */
	private function getMenuItems($type)
	{
		return isset($this->menuItems[$type]) ? $this->menuItems[$type] : [];
	}

	public function main()
	{
		return view('widget.menu::main')
			->with('menuItems', $this->getMenuItems(\App\Models\Menu::TYPE_MAIN));
	}

	public function product()
	{
		return view('widget.menu::product')
			->with('menuItems', $this->getMenuItems(\App\Models\Menu::TYPE_PRODUCT));
	}

	public function bottomLeft()
	{
		return view('widget.menu::bottom')
			->with('menuItems', $this->getMenuItems(\App\Models\Menu::TYPE_BOTTOM_LEFT));
	}

	public function bottomRight()
	{
		return view('widget.menu::bottom')
			->with('menuItems', $this->getMenuItems(\App\Models\Menu::TYPE_BOTTOM_RIGHT));
	}

	public function info()
	{
		return view('widget.menu::info')
			->with('menuItems', $this->getMenuItems(\App\Models\Menu::TYPE_INFO));
	}

}