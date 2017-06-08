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

class Review extends Model
{
	use Rules;
	
	protected $table = 'reviews';

	protected $imagePath = '/uploads/reviews/';

	/**
	 * Статус публикации (значение поля is_published)
	 */
	const UNPUBLISHED = 0;
	const PUBLISHED   = 1;

	public static $is_published = [
		self::UNPUBLISHED => 'Не опубликован',
		self::PUBLISHED   => 'Опубликован',
	];

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'is_published',
		'user_name',
		'user_email',
		'user_avatar',
		'text',
		'published_at',
	];

	/**
	 * @var array Validation rules
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
	 */
	public static $rules = [
		'is_published' => 'boolean',
		'user_name' => 'max:100',
		'user_email' => 'max:100',
		'user_avatar' => 'image|max:3072',
		'text' => 'required|max:1000',
	];
	
	/**
	 * Get validation rules for current field
	 *
	 * @param null $attribute
	 * @return array|mixed
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function getRules($attribute = null)
	{
		if($attribute) {
			return isset(self::$rules[$attribute])
				? [$attribute => self::$rules[$attribute]]
				: [$attribute => ''];
		}
		return self::$rules;
	}
	
	public static function boot()
	{
		parent::boot();
		
		static::addGlobalScope('order', function (Builder $builder) {
			$builder->orderBy('position', 'ASC');
		});
		
		static::saving(function($review) {
		
		});
		
		static::deleting(function($review) {
			$review->deleteImagesFolder();
		});
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
		return $this->user_avatar ? asset($this->imagePath . $this->id . '/' . $this->user_avatar) : '';
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
		$postImage = $request->file('user_avatar');
		$imagePath = $this->getImagesPath();
		if (isset($postImage)) {
			$fileName = Translit::generateFileName($postImage->getClientOriginalName());
			$image = Image::make($postImage->getRealPath());
			File::exists($imagePath) or File::makeDirectory($imagePath, 0755, true);

			// delete old image
			$this->deleteImage();
			
			$image->save($imagePath . 'origin_' . $fileName);
			
			if ($image->width() > 800) {
				$image->resize(800, null, function ($constraint) {
					$constraint->aspectRatio();
				})->save($imagePath . $fileName);
			} else {
				$image->save($imagePath . $fileName);
			}
			
			$this->user_avatar = $fileName;
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
			if(File::exists($this->getImagesPath() . $prefix . $this->user_avatar)) {
				File::delete($this->getImagesPath() . $prefix . $this->user_avatar);
			}
		}
		$this->user_avatar = null;
		
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
