<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

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
 * @property string $activation_code
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Page[] $pages
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\RequestedCall[] $requestedCalls
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User active()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereActivationCode($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereAvatar($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereCreatedAt($value)
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
    use Notifiable;
	
	/**
	 * Path of avatar of user
	 */
	protected $imagePath = '/uploads/users/{alias}/';
	protected $defaultImagePath = '/img/default-avatar.png';
	
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
	    'alias',
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
	
	public static function boot()
	{
		parent::boot();
		
		static::creating(function($user) {
			//
		});
		
		static::deleting(function($user) {
			$user->pages()->delete();
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
	 * Get user's avatar path
	 *
	 * @param bool $default
	 * @return mixed
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function getAvatarUrl($default = true) {
		// доделать с учетом незарегистрированных пользователей
		return $this->avatar
			? (
			preg_match("~^(?:f|ht)tps?://~i", $this->avatar)
				? $this->avatar
				: $this->imagePath //$this->getImagePath('avatar')
			)
			: ($default
				? url($this->defaultImagePath)
				: null);
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
	
	
}
