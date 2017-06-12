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
 * App\Models\Review
 *
 * @property int $id
 * @property bool $is_published
 * @property string $user_name
 * @property string $user_email
 * @property string $user_avatar
 * @property string $text
 * @property string $published_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property int $position
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Review published()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Review whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Review whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Review whereIsPublished($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Review wherePosition($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Review wherePublishedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Review whereText($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Review whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Review whereUserAvatar($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Review whereUserEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Review whereUserName($value)
 * @mixin \Eloquent
 */
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
		'position',
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
			\Cache::forget('widgets.reviews.vertical');
		});
		
		static::deleting(function($review) {
			$review->deleteImagesFolder();
			
			\Cache::forget('widgets.reviews.vertical');
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
	 * @param null $prefix (null, 'origin', 'mini')
	 * @return mixed
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function getImageUrl($prefix = null)
	{
		$prefix = is_null($prefix) ? '' : ($prefix . '_');
		return $this->user_avatar ? asset($this->imagePath . $this->id . '/' . $prefix . $this->user_avatar) : '';
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
		$postImage = $request->file('user_avatar')
			? $request->file('user_avatar')
			: $request->file('image');
		$imagePath = $this->getImagesPath();
		if (isset($postImage)) {
			$fileName = Translit::generateFileName($postImage->getClientOriginalName());
			$image = Image::make($postImage->getRealPath());
			File::exists($imagePath) or File::makeDirectory($imagePath, 0755, true);

			// delete old image
			$this->deleteImage();
			
			$image->save($imagePath . 'origin_' . $fileName);
			
			$cropSize = ($image->width() < $image->height()) ? $image->width() : $image->height();
			$image->crop($cropSize, $cropSize)
				->resize(120, 120, function ($constraint) {
					$constraint->aspectRatio();
				})->save($imagePath . $fileName);
			$image->resize(50, 50, function ($constraint) {
					$constraint->aspectRatio();
				})->save($imagePath . 'mini_' . $fileName);
			
			$this->user_avatar = $fileName;
			return true;
		} else {
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
		$prefixes = ['', 'origin_', 'mini_'];
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
