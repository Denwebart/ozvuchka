<?php
/**
 * Class RequestedCall
 *
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
 */

namespace App\Models;

use App\Helpers\Str;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\RequestedCall
 *
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property string $phone
 * @property bool $status
 * @property string $comment
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Query\Builder|\App\Models\RequestedCall whereComment($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\RequestedCall whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\RequestedCall whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\RequestedCall whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\RequestedCall wherePhone($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\RequestedCall whereStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\RequestedCall whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\RequestedCall whereUserId($value)
 * @mixin \Eloquent
 */
class RequestedCall extends Model
{
	protected $table = 'requested_calls';
	
	/**
	 * Статус заказанного звонка (значение поля status)
	 */
	const STATUS_NONE       = 0;
	const STATUS_PHONED     = 1;
	const STATUS_NOT_PHONED = 2;
	
	public static $statuses = [
		self::STATUS_NONE       => 'Не обработан',
		self::STATUS_PHONED     => 'Дозвонились',
		self::STATUS_NOT_PHONED => 'Не дозвонились',
	];

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'user_id',
		'name',
		'phone',
		'status',
		'comment',
		'answered_at',
	];

	/**
	 * @var array Validation rules
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2017 Website development studio It Hill (http://www.it-hill.com)
	 */
	public static $rules = [
		'user_id' => 'integer',
		'name' => 'required|max:50|regex:/^[A-Za-zА-Яа-яЁёЇїІіЄє \-\']+$/u',
		'phone' => 'required|max:50|regex:/^[0-9]+$/u',
	];
	
	/**
	 * @return mixed
	 */
	public function getPhone()
	{
		return Str::phoneFormat($this->phone);
	}

	/**
	 * Менеджер, ответивший на звонок
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function user()
	{
		return $this->belongsTo(User::class);
	}
}