<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use App\Traits\CRUD;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Promocode
 *
 * @property int $id
 * @property string $code
 * @property Carbon $expired_at
 * @property array|null $plan_ids
 * @property array|null $group_ids
 * @property int $percentage
 * @property string|null $details
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Collection|User[] $users
 *
 * @package App\Models
 */
class Promocode extends Model
{
    use CRUD;
	protected $table = 'promocodes';

	protected $casts = [
		'expired_at' => 'datetime',
		'plan_ids' => 'json',
		'group_ids' => 'json',
		'percentage' => 'int'
	];

	protected $fillable = [
		'code',
		'expired_at',
		'plan_ids',
		'group_ids',
		'percentage',
		'details'
	];

	public function users()
	{
		return $this->belongsToMany(User::class, 'promocode_users')
					->withPivot('id')
					->withTimestamps();
	}
}
