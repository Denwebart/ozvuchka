<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
 */

namespace App\Models;

use App\Helpers\Translit;
use App\Traits\Rules;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

/**
 * App\Models\TeamMember
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property string $image
 * @property string $image_alt
 * @property int $position
 * @property bool $is_published
 * @property string $link_website
 * @property string $link_vk
 * @property string $link_facebook
 * @property string $link_instagram
 * @property string $link_twitter
 * @property string $link_google
 * @property string $link_youtube
 * @property string $created_at
 * @property string $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\TeamMember published()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\TeamMember whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\TeamMember whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\TeamMember whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\TeamMember whereImage($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\TeamMember whereImageAlt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\TeamMember whereIsPublished($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\TeamMember whereLinkFacebook($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\TeamMember whereLinkGoogle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\TeamMember whereLinkInstagram($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\TeamMember whereLinkTwitter($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\TeamMember whereLinkVk($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\TeamMember whereLinkWebsite($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\TeamMember whereLinkYoutube($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\TeamMember whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\TeamMember wherePosition($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\TeamMember whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class TeamMember extends Model
{
	use Rules;
	
	protected $table = 'team_members';

	protected $imagePath = '/uploads/team_members/';

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
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name',
		'description',
		'image',
		'image_alt',
		'position',
		'is_published',
		'link_website',
		'link_vk',
		'link_facebook',
		'link_instagram',
		'link_twitter',
		'link_google',
		'link_youtube',
	];

	/**
	 * @var array Validation rules
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
	 */
	public static $rules = [
		'name' => 'required|max:255',
		'description' => 'max:255',
		'image' => 'image|max:10240',
		'image_alt' => 'max:255',
		'is_published' => 'boolean',
		'position' => 'integer',
		'link_website' => 'nullable|url|max:255',
		'link_vk' => 'nullable|url|max:255',
		'link_facebook' => 'nullable|url|max:255',
		'link_instagram' => 'nullable|url|max:255',
		'link_twitter' => 'nullable|url|max:255',
		'link_google' => 'nullable|url|max:255',
		'link_youtube' => 'nullable|url|max:255',
	];
	
	public static function boot()
	{
		parent::boot();
		
		static::addGlobalScope('order', function (Builder $builder) {
			$builder->orderBy('position', 'ASC');
		});
		
		static::saving(function($teamMember) {
			\Cache::forget('widgets.teamMembers');
		});
		
		static::deleting(function($teamMember) {
			$teamMember->deleteImagesFolder();
			
			\Cache::forget('widgets.teamMembers');
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
		return $query->whereIsPublished(1);
	}
	
	/**
	 * Get image url
	 *
	 * @param null $prefix (null, 'origin')
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
		if (isset($postImage)) {
			$fileName = Translit::generateFileName($postImage->getClientOriginalName());
			$imagePath = $this->getImagesPath();
			$image = Image::make($postImage->getRealPath());
			File::exists($imagePath) or File::makeDirectory($imagePath, 0755, true);

			// delete old image
			$this->deleteImage();

			$image->save($imagePath . 'origin_' . $fileName);
			
			if($image->width() > ($image->height() * 0.74)) {
				$image->resize(null, 460, function ($constraint) {
					$constraint->aspectRatio();
				});
			} else {
				$image->resize(340, null, function ($constraint) {
					$constraint->aspectRatio();
				});
			}
			
			$image->crop(340, 460)->save($imagePath . $fileName);
			
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
