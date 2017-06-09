<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
 */

namespace App\Models;

use App\Helpers\Translit;
use App\Traits\Rules;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

/**
 * App\Models\Gallery
 *
 * @property int $id
 * @property string $image
 * @property string $image_alt
 * @property string $title
 * @property string $description
 * @property bool $is_published
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $published_at
 * @property int $position
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\GalleryCategory[] $categories
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\GalleryGalleryCategory[] $galleryCategories
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Gallery published()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Gallery whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Gallery whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Gallery whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Gallery whereImage($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Gallery whereImageAlt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Gallery whereIsPublished($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Gallery wherePublishedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Gallery whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Gallery whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Gallery wherePosition($value)
 * @mixin \Eloquent
 */
class Gallery extends Model
{
	use Rules;
	
	protected $table = 'gallery';

	protected $imagePath = '/uploads/gallery/';

	/**
	 * Статус публикации (значение поля is_published)
	 */
	const UNPUBLISHED = 0;
	const PUBLISHED   = 1;

	public static $is_published = [
		self::UNPUBLISHED => 'Не опубликовано',
		self::PUBLISHED   => 'Опубликовано',
	];

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'image',
		'image_alt',
		'title',
		'description',
		'is_published',
		'published_at',
		'position',
	];

	/**
	 * @var array Validation rules
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
	 */
	public static $rules = [
		'image' => 'required|image|max:3072',
		'image_alt' => 'max:255',
		'title' => 'max:255',
		'description' => 'max:1000',
		'is_published' => 'boolean',
		'position' => 'integer',
	];

	public static function boot()
	{
		parent::boot();
		
		static::addGlobalScope('order', function (Builder $builder) {
			$builder->orderBy('position', 'DESC');
		});

		static::saving(function($page) {
			//
		});
		
		static::deleting(function($page) {
			$page->deleteImagesFolder();
		});
	}
	
	/**
	 * Images categories
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function categories()
	{
		return $this->belongsToMany(GalleryCategory::class, 'gallery_gallery_category');
	}
	
	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function galleryCategories()
	{
		return $this->hasMany(GalleryGalleryCategory::class);
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
