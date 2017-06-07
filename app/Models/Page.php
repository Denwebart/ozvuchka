<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
 */

namespace App\Models;

use App\Helpers\Str;
use App\Helpers\Translit;
use App\Traits\Rules;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

/**
 * App\Models\Page
 *
 * @property int $id
 * @property int $parent_id
 * @property int $user_id
 * @property bool $type
 * @property string $alias
 * @property bool $is_published
 * @property bool $is_container
 * @property string $title
 * @property string $menu_title
 * @property string $image
 * @property string $image_alt
 * @property string $introtext
 * @property string $content
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $published_at
 * @property string $meta_title
 * @property string $meta_desc
 * @property string $meta_key
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Page[] $children
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Menu[] $menus
 * @property-read \App\Models\Page $parent
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Page whereAlias($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Page whereContent($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Page whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Page whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Page whereImage($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Page whereImageAlt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Page whereIntrotext($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Page whereIsContainer($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Page whereIsPublished($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Page whereMenuTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Page whereMetaDesc($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Page whereMetaKey($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Page whereMetaTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Page whereParentId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Page wherePublishedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Page whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Page whereType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Page whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Page whereUserId($value)
 * @mixin \Eloquent
 */
class Page extends Model
{
	use Rules;
	
	protected $table = 'pages';

	protected $imagePath = '/uploads/pages/';

	/**
	 * Максимальная вложнность страниц
	 */
	const MAX_LEVEL = 4; // 4 уровня

	/**
	 * Id страниц с контактной формы и карты сайта
	 */
	const ID_CONTACT_PAGE = 2;
	const ID_SITEMAP_PAGE = 3;

	/**
	 * Тип страницы (значение поля type)
	 */
	const TYPE_PAGE        = 1;
	const TYPE_SYSTEM_PAGE = 2;

	public static $types = [
		self::TYPE_PAGE        => 'Страница',
		self::TYPE_SYSTEM_PAGE => 'Системная страница',
	];

	/**
	 * Статус публикации (значение поля is_published)
	 */
	const UNPUBLISHED = 0;
	const PUBLISHED   = 1;

	public static $is_published = [
		self::UNPUBLISHED => 'Не опубликована',
		self::PUBLISHED   => 'Опубликована',
	];

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'parent_id',
		'user_id',
		'type',
		'alias',
		'is_published',
		'is_container',
		'title',
		'menu_title',
		'image',
		'image_alt',
		'introtext',
		'content',
		'published_at',
		'meta_title',
		'meta_desc',
		'meta_key',
	];

	/**
	 * @var array Validation rules
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
	 */
	public static $rules = [
		'alias' => 'unique:pages,alias,:id|max:500|regex:/^[A-Za-z0-9\-_]+$/u',
		'parent_id' => 'integer',
		'user_id' => 'integer',
		'type' => 'integer',
		'is_published' => 'boolean',
		'is_container' => 'boolean',
		'title' => 'required_without:menu_title|max:250',
		'menu_title' => 'required_without:title|max:50',
		'image' => 'image|max:3072',
		'image_alt' => 'max:350',
		'meta_title' => 'max:300',
		'meta_desc' => 'max:300',
		'meta_key' => 'max:300',
	];

	public static function boot()
	{
		parent::boot();

		static::saving(function($page) {
			if(!$page->isMain()) {
				$page->alias = Translit::generateAlias($page->getTitle(), $page->alias);
			} else {
				$page->alias = '/';
			}
			$page->deleteEditorImages();
		});
		
		static::deleting(function($page) {
			if(count($page->menus)) {
				\Cache::forget('menuItems');
				$page->menus()->delete();
			}
			
			$page->children()->delete();
			$page->deleteImagesFolder();
		});
	}

	/**
	 * Автор
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function user()
	{
		return $this->belongsTo(User::class);
	}

	/**
	 * Родительская страница
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function parent()
	{
		return $this->belongsTo(Page::class, 'parent_id');
	}

	/**
	 * Все дочерние страницы
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function children()
	{
		return $this->hasMany(Page::class, 'parent_id');
	}

	/**
	 * Все пункты меню
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function menus()
	{
		return $this->hasMany(Menu::class);
	}
	
	/**
	 * Scope a query to only include active pages.
	 *
	 * @param \Illuminate\Database\Eloquent\Builder $query
	 * @return \Illuminate\Database\Eloquent\Builder
	 */
	public function scopePublished($query)
	{
		return $query->whereIsPublished(1)->where('published_at', '<=', Carbon::now());
	}
	
	/**
	 * Is main page?
	 * @return bool
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function isMain()
	{
		return $this->id == 1 ? true : false;
	}

	/**
	 * Can page be deleted?
	 * @return bool
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function canBeDeleted()
	{
		return ($this->type != self::TYPE_SYSTEM_PAGE) ? true : false;
	}

	/**
	 * Get page title (menu_title or title)
	 * 
	 * @return mixed
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function getTitle()
	{
		return $this->menu_title ? $this->menu_title : $this->title;
	}

	public function getMetaTitle()
	{
		return $this->meta_title
			? $this->meta_title
			: ($this->getTitle() ? $this->getTitle() : '');
	}

	public function getMetaDesc()
	{
		return $this->meta_desc ? $this->meta_desc : '';
	}

	public function getMetaKey()
	{
		return $this->meta_key ? $this->meta_key : '';
	}
	
	/**
	 * Description for meta-tag og:description
	 * @param null $limit
	 * @return string
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function getDescription($limit = null)
	{
		$limit = $limit ? $limit : 250;
		return $this->introtext
			? Str::closeTags(Str::limit($this->introtext, $limit))
			: Str::closeTags(Str::limit($this->content, $limit));
	}
	
	public function getIntrotext($limit = null)
	{
		$limit = $limit ? $limit : 500;
		return $this->introtext
			? $this->introtext
			: Str::closeTags(Str::limit($this->content, $limit));
	}
	
	public function getPageImage()
	{
		return $this->getImageUrl()
			? $this->getImageUrl()
			: ($image = Str::getImageFromHtml($this->content))
				? $image
				: '';
	}

	/**
	 * Get page url
	 *
	 * @return mixed
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
	 */
	public static function getPageUrl($id)
	{
		$page = Page::select(['id', 'parent_id', 'alias'])
			->whereId($id)
			->first();

		return $page ? $page->getUrl() : false;
	}

	/**
	 * Get page url
	 *
	 * @param bool $withoutDomain
	 * @return mixed
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function getUrl($withoutDomain = false)
	{
		if($this->parent_id) {
			$url = $this->parent->getUrl($withoutDomain) . '/' . $this->alias;
		} else {
			$url = $this->alias == '/' ? '/' : '/' . $this->alias;
		}
		
		return $withoutDomain ? $url : url($url);
	}

	/**
	 * Get array with breadcrumb items
	 *
	 * @return array
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function getBreadcrumbItems()
	{
		$items[] = [
			'url' => url('/'),
			'title' => 'Главная',
		];
		$items = $items + $this->getBredcrumbItem($this, 1);
		$items[] = [
			'url' => null,
			'title' => $this->getTitle(),
		];

		return $items;
	}

	/**
	 * Recursive function for get breadcrumbs item
	 *
	 * @param $level
	 * @return array
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function getBredcrumbItem($page, $level)
	{
		if($page->parent_id !=0 && $page->parent) {
			$items = $page->getBredcrumbItem($page->parent, $level + 1);
			$items[$level] = [
				'url' => $page->parent->getUrl(),
				'title' => $page->parent->getTitle(),
			];
		}
		return isset($items) ? $items : [];
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
		return $this->image ? asset($this->imagePath . $this->id . '/' . $this->image) : '';
	}
	
	/**
	 * Getting the path for loading images through the editor
	 *
	 * @return string
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function getImageEditorPath() {
		return $this->imagePath . $this->id . '/editor/';
	}
	
	/**
	 * Get a temporary path for loading an image
	 *
	 * @return string
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function getTempPath() {
		return '/uploads/temp/' . \Illuminate\Support\Str::random(20) . '/';
	}
	
	/**
	 * Moving images from a temporary folder
	 *
	 * @param $tempPath
	 * @param string $field
	 * @return mixed
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function saveEditorImages($tempPath, $field = 'content')
	{
		$moveDirectory = File::copyDirectory(public_path($tempPath), public_path($this->getImageEditorPath()));
		if($moveDirectory) {
			File::deleteDirectory(public_path($tempPath));
		}
		
		return str_replace($tempPath, $this->getImageEditorPath(), $this->$field);
	}
	
	/**
	 * Deliting images wich where uploaded by editor
	 *
	 * @return bool
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function deleteEditorImages()
	{
		$fieldsValue = $this->introtext . $this->content;
		// Deleting files from directory
		if(File::exists(public_path($this->getImageEditorPath()))) {
			$files = File::allFiles(public_path($this->getImageEditorPath()));
			foreach($files as $file)
			{
				if(strpos($fieldsValue, $file->getFilename()) === false) {
					if(File::exists($file)) {
						$filename = $file->getPath() . $file->getFilename();
						File::delete($filename);
					}
				}
			}
		}
		
		return true;
	}

	/**
	 * Get categories array
	 *
	 * @param bool $pageType
	 * @param bool $empty
	 * @return array List of categories (id => title)
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
	 */
	public static function getCategory($pageType = false, $empty = true)
	{
		$query = new Page();
		$query = $query->select('id', 'parent_id', 'alias', 'title', 'menu_title', 'is_container', 'type');
		$query = $query->whereIsContainer(1)
			->whereParentId(0)
			->where('type', '!=', self::TYPE_SYSTEM_PAGE);

		if($pageType) {
			$query = $query->where('type', '=', $pageType);
		}

		$pages = $query->get();
		
		$array = [];
		if($empty) {
			$array[0] = '&mdash;'; // тире
		}
		foreach ($pages as $page) {
			$array[$page->id] = $page->getTitle();

			$array = $array + self::getCategoryChildren($page, 1);
		}
		return $array;
	}

	/**
	 * Recursive function for get child page array
	 *
	 * @param $page
	 * @param $level
	 * @return array
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
	 *
	 */
	protected static function getCategoryChildren($page, $level)
	{
		if($level < (self::MAX_LEVEL - 1)) {
			if(count($page->children)) {
				foreach($page->children()->whereIsContainer(1)->get() as $child) {
					$array[$child->id] = ' ' . str_repeat('&mdash; ', $level) . $child->getTitle();
					if(count($child->children)) {
						$array = $array + self::getCategoryChildren($child, $level + 1);
					}
				}
			}
		}
		return isset($array) ? $array : [];
	}
	
	/**
	 * Заполнение данных при создании и редактировании
	 * 
	 * @param $data
	 * @return mixed
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function setData($data)
	{
		if ($data['is_published'] && is_null($this->published_at)) {
			$data['published_at'] = Carbon::now();
		} elseif (!$data['is_published']) {
			$data['published_at'] = null;
		}

		if(!$this->type && $this->type != Page::TYPE_SYSTEM_PAGE) {
			$data['type'] = Page::TYPE_PAGE;
		}

		$data['user_id'] = $this->user_id ? $this->user_id : Auth::user()->id;
		
		$pageTitle = $data['menu_title'] ? $data['menu_title'] : $data['title'];
		$data['alias'] = Translit::generateAlias($pageTitle, $data['alias']);
		
		return $data;
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
		return public_path($this->imagePath . $this->id . '/');
	}

	/**
	 * Image uploading
	 *
	 * @param Request $request
	 * @return bool
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function setImage(Request $request)
	{
		$postImage = $request->file('image');
		$imagePath = $this->getImagesPath();
		if (isset($postImage)) {
			$fileName = Translit::generateFileName($postImage->getClientOriginalName());
			$image = Image::make($postImage->getRealPath());
			File::exists($imagePath) or File::makeDirectory($imagePath, 0755, true);

			// delete old image
			$this->deleteImage();

			$watermark = Image::make(public_path('images/watermark.png'));
			$watermark->resize(($image->width() * 2) / 3, null, function ($constraint) {
				$constraint->aspectRatio();
			})->save($imagePath . 'watermark.png');

			$image->insert($imagePath . 'watermark.png', 'center')
				->save($imagePath . 'origin_' . $fileName);
			
			if (File::exists($imagePath . 'watermark.png')) {
				File::delete($imagePath . 'watermark.png');
			}
			
			if ($image->width() > 800) {
				$image->resize(800, null, function ($constraint) {
					$constraint->aspectRatio();
				})->save($imagePath . $fileName);
			} else {
				$image->save($imagePath . $fileName);
			}
			
			$this->image = $fileName;
			return true;
		} else {
			if($request->get('deleteImage')) {
				$this->deleteImage();
				if(!File::exists($imagePath . 'images')) {
					$this->deleteImagesFolder();
				}
				return true;
			}
			return false;
		}
	}

	/**
	 * Delete old image
	 *
	 * @return bool
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function deleteImage()
	{
		$prefixes = ['', 'origin_'];
		// delete old image
		foreach ($prefixes as $prefix) {
			if(File::exists($this->getImagesPath() . $prefix . $this->image)) {
				File::delete($this->getImagesPath() . $prefix . $this->image);
			}
		}
		$this->image = null;
		
		return true;
	}

	/**
	 * Delete image folder
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function deleteImagesFolder()
	{
		File::deleteDirectory($this->getImagesPath());
	}
}
