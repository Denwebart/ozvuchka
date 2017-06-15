<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\GalleryCategory
 *
 * @property string $title
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\GalleryGalleryCategory[] $galleryCategories
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Gallery[] $galleryImages
 * @method static \Illuminate\Database\Query\Builder|\App\Models\GalleryGalleryCategory whereTitle($value)
 * @mixin \Eloquent
 * @property int $id
 * @method static \Illuminate\Database\Query\Builder|\App\Models\GalleryCategory whereId($value)
 */
class GalleryCategory extends Model
{
	protected $table = 'gallery_categories';
	
	public $timestamps = false;
	
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'title',
	];

	/**
	 * @var array Validation rules
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
	 */
	public static $rules = [
		'title' => 'required|max:100',
	];

	public static function boot()
	{
		parent::boot();

		static::saving(function($page) {
			\Cache::forget('pages.gallery.galleryImages');
			\Cache::forget('pages.gallery.galleryCategories');
		});
		
		static::deleting(function($page) {
			\Cache::forget('pages.gallery.galleryImages');
			\Cache::forget('pages.gallery.galleryCategories');
		});
	}
	
	/**
	 * Images category
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function galleryImages()
	{
		return $this->belongsToMany(Gallery::class, 'gallery_gallery_categories', 'category_id', 'gallery_id');
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
}
