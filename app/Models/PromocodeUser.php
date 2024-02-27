<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class PromocodeUser
 * 
 * @property int $id
 * @property int $promocode_id
 * @property int $user_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Promocode $promocode
 * @property User $user
 *
 * @package App\Models
 */
class PromocodeUser extends Model
{
	protected $table = 'promocode_users';

	protected $casts = [
		'promocode_id' => 'int',
		'user_id' => 'int'
	];

	protected $fillable = [
		'promocode_id',
		'user_id'
	];

	public function promocode()
	{
		return $this->belongsTo(Promocode::class);
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
