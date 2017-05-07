<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
 */

namespace App\Models;

use App\Helpers\Translit;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

/**
 * App\Models\Slider
 *
 * @property int $id
 * @property string $image
 * @property string $image_alt
 * @property bool $is_published
 * @property string $title
 * @property string $text
 * @property string $button_text
 * @property string $button_link
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Slider whereButtonLink($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Slider whereButtonText($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Slider whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Slider whereImage($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Slider whereImageAlt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Slider whereIsPublished($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Slider whereText($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Slider whereTitle($value)
 * @mixin \Eloquent
 */
class Slider extends Model
{
	protected $table = 'slider';

	protected $imagePath = '/uploads/slider/';

	public $timestamps = false;

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
	 * Выравнивание текста (значение поля text_align)
	 */
	const ALIGN_CENTER = 0;
	const ALIGN_LEFT   = 1;
	const ALIGN_RIGHT  = 2;

	public static $textAlign = [
		self::ALIGN_LEFT   => 'По левому краю',
		self::ALIGN_CENTER => 'По центру',
		self::ALIGN_RIGHT  => 'По правому краю',
	];

	public static $textAlignClasses = [
		self::ALIGN_CENTER => 'align-center',
		self::ALIGN_LEFT   => 'align-left',
		self::ALIGN_RIGHT  => 'align-right',
	];

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'id',
		'image',
		'image_alt',
		'title',
		'text_1',
		'text_2',
		'is_published',
		'button_text',
		'button_link',
		'text_align',
	];

	/**
	 * @var array Validation rules
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
	 */
	protected static $rules = [
		'id' => '',
		'image' => 'required|image|max:10240',
		'image_alt' => 'max:350',
		'title' => 'max:250',
		'text' => 'max:250',
		'is_published' => 'boolean',
		'button_text' => 'max:100',
		'button_link' => 'url|max:250',
		'text_align' => 'integer|min:0|max:2',
	];
	
	public static function boot()
	{
		parent::boot();
		
		static::saving(function($slide) {
			\Cache::forget('widgets.slider');
		});
		
		static::deleting(function($slide) {
			\Cache::forget('widgets.slider');
		});
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
		if (isset($postImage)) {
			$fileName = Translit::generateFileName($postImage->getClientOriginalName());
			$imagePath = public_path() . $this->imagePath . $this->id . '/';
			$image = Image::make($postImage->getRealPath());
			File::exists($imagePath) or File::makeDirectory($imagePath, 0755, true);

			// delete old image
			$this->deleteImage();

			$image->save($imagePath . 'origin_' . $fileName);

			if ($image->width() >= 1140) {
				$image->resize(1140, null, function ($constraint) {
					$constraint->aspectRatio();
				})->save($imagePath . $fileName);
			} else {
				$image->save($imagePath . $fileName);
			}

			$this->image = $fileName;
			return true;
		} else {
			return false;
		}
	}

	/**
	 * Delete old image
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function deleteImage()
	{
		$imagePath = public_path() . $this->imagePath . $this->id . '/';
		// delete old image
		if(File::exists($imagePath . $this->image)) {
			File::delete($imagePath . $this->image);
		}
		if(File::exists($imagePath . 'origin_' . $this->image)) {
			File::delete($imagePath . 'origin_' . $this->image);
		}
		$this->image = null;
	}
}
