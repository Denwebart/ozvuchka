<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Menu
 *
 * @property int $id
 * @property bool $type
 * @property int $page_id
 * @property int $parent_id
 * @property int $position
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Menu[] $children
 * @property-read \App\Models\Page $page
 * @property-read \App\Models\Menu $parent
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Menu whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Menu wherePageId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Menu whereParentId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Menu wherePosition($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Menu whereType($value)
 * @mixin \Eloquent
 */
class Menu extends Model
{
	protected $table = 'menus';

	public $timestamps = false;

	/**
	 * Тип меню (значение поля type)
	 */
	const TYPE_MAIN = 1;

	public static $types = [
		self::TYPE_MAIN => 'Главное меню',
	];

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'type',
		'parent_id',
		'page_id',
		'position',
	];

	/**
	 * @var array Validation rules
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
	 */
	protected static $rules = [
		'type' => 'integer',
		'parent_id' => 'integer',
		'page_id' => 'required|integer',
		'position' => 'integer',
	];

	/**
	 * Страница
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function page()
	{
		return $this->belongsTo(Page::class);
	}

	/**
	 * Родительский пункт меню
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function parent()
	{
		return $this->belongsTo(Menu::class, 'parent_id');
	}

	/**
	 * Дочерние пункты меню
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function children()
	{
		return $this->hasMany(Menu::class, 'parent_id');
	}

	/**
	 * Get all menu items as array
	 *
	 * @param integer $type
	 * @return array
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
	 */
	public static function getMenuItems($type = null)
	{
		$query = self::whereParentId(0)
			->has('page')
			->with([
				'page' => function($query) {
					$query->select('id', 'alias', 'type', 'is_container', 'parent_id', 'title', 'menu_title');
				},
				'page.children' => function($query) {
					$query->select('id', 'alias', 'type', 'is_container', 'parent_id', 'title', 'menu_title');
				},
				'page.children.parent' => function($query) {
					$query->select('id', 'alias', 'type', 'is_container', 'parent_id', 'title', 'menu_title');
				},
			]);
			if($type) {
				$query = $query->whereType($type);
			}
		$allItems = $query->orderBy('position', 'ASC')->get();

		foreach ($allItems as $item) {
			if($type) {
				$result[$item->id] = $item;
			} else {
				$result[$item->type][$item->id] = $item;
			}
		}

		return isset($result) ? $result : [];
	}
}
