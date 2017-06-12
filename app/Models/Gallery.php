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
			\Cache::forget('widgets.gallery');
		});
		
		static::deleting(function($page) {
			$page->deleteImagesFolder();
			
			\Cache::forget('widgets.gallery');
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
	 * @param null $prefix (null, 'origin', 'full')
	 * @return mixed
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function getImageUrl($prefix = null)
	{
		$prefix = is_null($prefix) ? '' : ($prefix . '_');
		return $this->image ? asset($this->imagePath . $this->id . '/' . $prefix . $this->image) : '';
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
			
			$image->save($imagePath . 'origin_' . $fileName);
			
			$watermark = Image::make(public_path('images/watermark.png'));
			$watermark->resize(($image->width() * 2) / 3, null, function ($constraint) {
				$constraint->aspectRatio();
			})->save($imagePath . 'watermark.png');
			
			if($image->width() > $image->height()) {
				// horizontal image
				if($image->width() > ($image->height() * 1.65)) {
					$image->resize(null, $image->height(), function ($constraint) {
						$constraint->aspectRatio();
					});
					$height = $image->height();
					$width = $image->height() * 1.65;
				} else {
					$image->resize($image->width(), null, function ($constraint) {
						$constraint->aspectRatio();
					});
					$width = $image->width();
					$height = $image->width() / 1.64;
				}
			} else {
				// vertical image
				if($image->height() > ($image->width() / 0.82)) {
					$image->resize(null, 900, function ($constraint) {
						$constraint->aspectRatio();
					});
					$width = $image->width();
					$height = $image->width() / 0.82;
				} else {
					$image->resize(740, null, function ($constraint) {
						$constraint->aspectRatio();
					});
					$height = $image->height();
					$width = $image->height() * 0.83;
				}
			}
			
			$image->insert($imagePath . 'watermark.png', 'center')
				->crop((integer) $width, (integer) $height)
				->save($imagePath . 'full_' . $fileName);
			
			$width = 370;
			$height = 225;
			if($image->width() < $image->height()) {
				$height = $height * 2;
			}
			
			$image->resize($width, $height)->save($imagePath . $fileName);
			
			if (File::exists($imagePath . 'watermark.png')) {
				File::delete($imagePath . 'watermark.png');
			}
			
			$this->image = $fileName;
			return true;
		} else {
			if($request->get('deleteImage')) {
				$this->deleteImage();
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
		$prefixes = ['', 'origin_', 'full_'];
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
