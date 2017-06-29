<?php

namespace App\Models;

use App\Helpers\Translit;
use App\Traits\Rules;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

/**
 * App\Models\User
 *
 * @property int $id
 * @property bool $role
 * @property string $login
 * @property string $email
 * @property bool $is_active
 * @property string $avatar
 * @property string $firstname
 * @property string $lastname
 * @property string $description
 * @property string $password
 * @property string $remember_token
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property bool $deleted_at
 * @property string $activation_code
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Page[] $comments
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Page[] $pages
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\RequestedCall[] $requestedCalls
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User active()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereActivationCode($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereAvatar($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereFirstname($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereIsActive($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereLastname($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereLogin($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User wherePassword($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereRememberToken($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereRole($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class User extends Authenticatable
{
    use Notifiable, Rules;
	
	/**
	 * Path of avatar of user
	 */
	protected $imagePath = '/uploads/users/';
	protected $defaultImagePath = '/images/default-avatar.png';
	
	/**
	 * Role
	 */
	const ROLE_NONE = 0;
	const ROLE_ADMIN = 1;
	const ROLE_MODERATOR = 2;
	
	public static $roles = [
		self::ROLE_NONE => 'Не задана',
		self::ROLE_ADMIN => 'Администратор',
		self::ROLE_MODERATOR => 'Модератор',
	];
	
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
	    'role',
	    'login',
	    'email',
	    'avatar',
	    'firstname',
	    'lastname',
	    'description',
	    'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
	
	/**
	 * @var array Validation rules
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
	 */
	public static $rules = [
		'role' => 'integer',
		'login' => 'required|unique:users,login,:id|max:20|regex:/^[0-9A-Za-z\-\']+$/u',
		'email' => 'required|unique:users,email,:id|email|max:100',
		'password' => 'nullable|min:6|max:100',
		'password_confirmation' => 'required_with:password|same:password',
		'avatar' => 'image|max:3072',
		'firstname' => 'max:100',
		'lastname' => 'max:100',
		'description' => 'max:1000',
	];
	
	public static function boot()
	{
		parent::boot();
		
		static::creating(function($user) {
			//
		});
		
		static::deleting(function($user) {
			if(count($user->pages) || count($user->comments) || count($user->requestedCalls)) {
				$user->deleted_at = Carbon::now();
				$user->save();
				return false;
			}
		});
	}
	
	/**
	 * Pages of the user
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function pages()
	{
		return $this->hasMany(Page::class);
	}
	
	/**Comments of User
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function comments()
	{
		return $this->hasMany(Page::class);
	}
	
	/**
	 * Принятые звонки
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function requestedCalls()
	{
		return $this->hasMany(RequestedCall::class);
	}
	
	/**
	 * Scope a query to only include active users.
	 *
	 * @param \Illuminate\Database\Eloquent\Builder $query
	 * @return \Illuminate\Database\Eloquent\Builder
	 */
	public function scopeActive($query)
	{
		return $query->where('role', '!=', self::ROLE_NONE)->whereNotNull('remember_token');
	}
	
	/**
	 * Check is activated account
	 *
	 * @return bool
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function isActive()
	{
		return $this->role == self::ROLE_NONE && is_null($this->remember_token)
			? false : true;
	}
	
	/**
	 * Is superadmin?
	 * @return bool
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function isSuperadmin()
	{
		return $this->id == 1 ? true : false;
	}
	
	/**
	 * Is user has admin permission?
	 *
	 * @return bool
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function hasAdminPermission()
	{
		return $this->isSuperadmin() || $this->role == self::ROLE_ADMIN ? true : false;
	}
	
	/**
	 * Is user has moderator permission?
	 *
	 * @return bool
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function hasModeratorPermission()
	{
		return $this->role == self::ROLE_MODERATOR || $this->role == self::ROLE_ADMIN ? true : false;
	}
	
	/**
	 * Get user full name
	 *
	 * @return string
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function getFullName()
	{
		$separator = ($this->firstname && $this->lastname) ? ' ' : '';
		return $this->firstname . $separator . $this->lastname;
	}
	
	/**
	 * Get user's avatar path
	 *
	 * @param bool $default
	 * @param null $prefix (null, 'origin', 'mini')
	 * @return mixed
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function getAvatarUrl($default = true, $prefix = null) {
		// доделать с учетом незарегистрированных пользователей
		$prefix = is_null($prefix) ? '' : ($prefix . '_');
		return $this->avatar
			? (
			preg_match("~^(?:f|ht)tps?://~i", $this->avatar)
				? $this->avatar
				: $this->imagePath . $this->login . '/' . $prefix . $this->avatar
			)
			: ($default
				? url($this->defaultImagePath)
				: null);
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
		return public_path($this->imagePath . $this->login . '/');
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
		$postImage = $request->file('avatar');
		if (isset($postImage)) {
			$fileName = Translit::generateFileName($postImage->getClientOriginalName());
			$imagePath = $this->getImagesPath();
			$image = Image::make($postImage->getRealPath());
			File::exists($imagePath) or File::makeDirectory($imagePath, 0755, true);
			
			// delete old image
			$this->deleteImage();
			
			$image->save($imagePath . 'origin_' . $fileName);
			
			$cropSize = ($image->width() < $image->height()) ? $image->width() : $image->height();
			$image->crop($cropSize, $cropSize)
				->resize(340, 340, function ($constraint) {
					$constraint->aspectRatio();
				})->save($imagePath . $fileName);
			$image->resize(50, 50, function ($constraint) {
				$constraint->aspectRatio();
			})->save($imagePath . 'mini_' . $fileName);
			
			$this->avatar = $fileName;
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
		$prefixes = ['', 'origin_', 'mini_'];
		// delete old image
		foreach ($prefixes as $prefix) {
			if(File::exists($this->getImagesPath() . $prefix . $this->avatar)) {
				File::delete($this->getImagesPath() . $prefix . $this->avatar);
			}
		}
		$this->avatar = null;
		
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
