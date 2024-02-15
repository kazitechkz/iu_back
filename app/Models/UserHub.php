<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class UserHub
 *
 * @property int $id
 * @property int $user_id
 * @property int $hub_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Hub $hub
 * @property User $user
 *
 * @package App\Models
 */
class UserHub extends Model
{
	protected $table = 'user_hubs';

	protected $casts = [
		'user_id' => 'int',
		'hub_id' => 'int'
	];

	protected $fillable = [
		'user_id',
		'hub_id'
	];

	public function hub()
	{
		return $this->belongsTo(Hub::class);
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
