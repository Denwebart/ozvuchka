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
 * App\Models\GalleryGalleryCategory
 *
 * @property int $gallery_id
 * @property int $category_id
 * @property-read \App\Models\GalleryCategory $category
 * @property-read \App\Models\Gallery $gallery
 * @method static \Illuminate\Database\Query\Builder|\App\Models\GalleryGalleryCategory whereCategoryId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\GalleryGalleryCategory whereGalleryId($value)
 * @mixin \Eloquent
 */
class GalleryGalleryCategory extends Model
{
	protected $table = 'gallery_gallery_categories';
	
	protected $primaryKey = ['gallery_id','category_id'];
	
	public $incrementing = false;
	
	public $timestamps = false;
	
	protected $fillable = [
		'gallery_id',
		'category_id',
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
	
	public function gallery()
	{
		return $this->belongsTo(Gallery::class, 'gallery_id');
	}
	
	public function category()
	{
		return $this->belongsTo(GalleryCategory::class, 'category_id');
	}
}
