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
	
	public function gallery()
	{
		return $this->belongsTo(Gallery::class, 'gallery_id');
	}
	
	public function category()
	{
		return $this->belongsTo(GalleryCategory::class, 'category_id');
	}
}
