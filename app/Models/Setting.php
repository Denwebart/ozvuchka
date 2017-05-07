<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Setting
 *
 * @property int $id
 * @property string $key
 * @property bool $category
 * @property bool $type
 * @property string $title
 * @property string $description
 * @property string $value
 * @property bool $is_active
 * @property string $validation_rule
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Setting whereCategory($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Setting whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Setting whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Setting whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Setting whereIsActive($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Setting whereKey($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Setting whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Setting whereType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Setting whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Setting whereValidationRule($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Setting whereValue($value)
 * @mixin \Eloquent
 */
class Setting extends Model
{
	protected $table = 'settings';
	
	protected $imagePath = '/uploads/settings/';
	
	/**
	 * Тип настройки (значение поля type)
	 */
	const TYPE_BOOLEAN = 1;
	const TYPE_INTEGER = 2;
	const TYPE_TEXT    = 3;
	const TYPE_STRING  = 4;
	const TYPE_HTML    = 5;
	const TYPE_IMAGE   = 6;

	public static $types = [
		self::TYPE_BOOLEAN => 'Логическое значение',
		self::TYPE_INTEGER => 'Целое число',
		self::TYPE_TEXT    => 'Длинный текст',
		self::TYPE_STRING  => 'Короткий текст',
		self::TYPE_HTML    => 'HTML-код',
		self::TYPE_IMAGE   => 'Изображение',
	];

	/**
	 * Статус публикации (значение поля is_active)
	 */
	const INACTIVE = 0;
	const ACTIVE   = 1;

	public static $is_active = [
		self::INACTIVE => 'Отключена',
		self::ACTIVE   => 'Включена',
	];

	/**
	 * Категория настройки (значение поля category)
	 */
	const CATEGORY_SITE         = 1;
	const CATEGORY_CONTACT_PAGE = 2;
	const CATEGORY_SYSTEM       = 3;

	public static $categories = [
		self::CATEGORY_SITE         => 'Общие настройки сайта',
		self::CATEGORY_CONTACT_PAGE => 'Контактная информация',
		self::CATEGORY_SYSTEM       => 'Системные настройки',
	];

	/**
	 * Иконки для контактной информации
	 */
	public static $contactInfoIcons = [
		'address' => 'home',
		'phones' => 'phone',
		'email' => 'envelope',
		'skype' => 'skype',
	];

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'value',
		'is_active',
	];

	/**
	 * @var array Validation rules
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
	 */
	protected static $rules = [
		'is_active' => 'boolean',
	];

	/**
	 * Get validation rules for current setting
	 *
	 * @return array
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function getRules()
	{
		$rules = self::$rules;
		$rules['value'] = $this->validation_rule;
		return $rules;
	}

	/**
	 * Get validation message for current setting
	 *
	 * @return array
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function getMessages()
	{
		$messages = [
			'map.latitude' => [
				'regex' => 'Поле должно содержать правильные географические координаты (в градусах).',
			],
			'map.longitude' => [
				'regex' => 'Поле должно содержать правильные географические координаты (в градусах).',
			],
		];

		return isset($messages[$this->key]) ? $messages[$this->key] : [];
	}
	
	public static function boot()
	{
		parent::boot();
		
		static::saving(function($setting) {
			\Cache::forget('settings.setting-key-' . $setting->key);
			\Cache::forget('settings.category-' . $setting->category);
			\Cache::forget('settings');
		});
		
		static::deleting(function($setting) {
			\Cache::forget('settings.setting-key-' . $setting->key);
			\Cache::forget('settings.category-' . $setting->category);
			\Cache::forget('settings');
		});
	}
	
	public function getImagePath()
	{
		return $this->imagePath;
	}
	
	/**
	 * Get image url
	 *
	 * @return mixed
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function getImageUrl()
	{
		return $this->value
			? asset($this->imagePath . $this->key . '/' . $this->value)
			: '';
	}
	
	/**
	 * Get image path
	 *
	 * @return mixed
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function getImagesPath()
	{
		return public_path() . $this->imagePath . $this->key . '/';
	}
}
