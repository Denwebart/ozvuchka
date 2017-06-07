<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
 */

namespace App\Models;

use App\Helpers\Translit;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class GalleryCategory extends Model
{
	protected $table = 'gallery_categeories';

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
		
		});
		
		static::deleting(function($page) {
		
		});
	}
	
	/**
	 * Images category
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function images()
	{
		return $this->belongsToMany(Gallery::class, 'gallery_gallery_category');
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
