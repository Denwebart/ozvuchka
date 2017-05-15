<?php
/**
 * Class Settings
 *
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */

namespace App\Helpers;

use App\Models\Setting;

class Settings
{
	/**
	 * @param $key
	 * @return \Illuminate\Database\Eloquent\Model|mixed|null|static
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function get($key)
	{
		$setting = \Cache::rememberForever('settings.setting-key-' . $key, function() use($key) {
			return Setting::whereKey($key)->whereIsActive(1)->first();
		});
		
		return $setting ? $setting : null;
	}

	/**
	 * @param $category
	 * @return array
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function getCategory($category)
	{
		$settings = \Cache::rememberForever('settings.category-' . $category, function() use($category) {
			$settings = Setting::select(['id', 'key', 'category', 'title', 'value', 'is_active'])
				->whereCategory($category)
				->whereIsActive(1)
				->whereNotNull('value')
				->get();
			
			foreach ($settings as $setting) {
				$settingsLevel = explode('.', $setting->key);
				if(isset($settingsLevel[1])) {
					$result[$settingsLevel[0]][$settingsLevel[1]] = $setting;
				} else {
					$result[$settingsLevel[0]] = $setting;
				}
			}
			
			return isset($result) ? $result : [];
		});
		
		return $settings;
	}

	/**
	 * @return array
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function getAll()
	{
		$settings = \Cache::rememberForever('settings', function() {
			return Setting::all();
		});

		foreach ($settings as $setting) {
			$settingsLevel = explode('.', $setting->key);
			if(isset($settingsLevel[1])) {
				$result[$setting->category][$settingsLevel[0]][$settingsLevel[1]] = $setting;
			} else {
				$result[$setting->category][$settingsLevel[0]] = $setting;
			}
		}
		return isset($result) ? $result : [];
	}
}