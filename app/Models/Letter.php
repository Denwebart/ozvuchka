<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Letter
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $subject
 * @property string $message
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $read_at
 * @property string $deleted_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Letter whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Letter whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Letter whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Letter whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Letter whereMessage($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Letter whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Letter whereReadAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Letter whereSubject($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Letter whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property bool $is_important
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Letter whereIsImportant($value)
 */
class Letter extends Model
{
	protected $table = 'letters';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name',
		'email',
		'subject',
		'message',
	];

	/**
	 * @var array Validation rules
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
	 */
	public static $rules = [
		'name' => 'required|max:50|regex:/^[A-Za-zА-Яа-яЁёЇїІіЄє \-\']+$/u',
		'email' => 'required|email|max:255',
		'subject' => 'max:250',
		'message' => 'required|min:3',
	];
	
	public static function boot()
	{
		parent::boot();
		
		static::creating(function($letter) {
			//
		});
		
		static::deleting(function($letter) {
			if(!$letter->deleted_at) {
				$letter->deleted_at = Carbon::now();
				$letter->save();
				return false;
			}
		});
	}
}