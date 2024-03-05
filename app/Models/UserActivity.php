<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class UserActivity
 * 
 * @property int $id
 * @property int $user_id
 * @property string|null $ip
 * @property Carbon $last_login
 * @property Carbon $last_bonus
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property User $user
 *
 * @package App\Models
 */
class UserActivity extends Model
{
	protected $table = 'user_activities';

	protected $casts = [
		'user_id' => 'int',
		'last_login' => 'datetime',
		'last_bonus' => 'datetime'
	];

	protected $fillable = [
		'user_id',
		'ip',
		'last_login',
		'last_bonus'
	];

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
