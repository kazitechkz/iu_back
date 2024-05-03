<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Cash
 * 
 * @property int $id
 * @property int $user_id
 * @property int $balance
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property User $user
 *
 * @package App\Models
 */
class Cash extends Model
{
	protected $table = 'cashes';

	protected $casts = [
		'user_id' => 'int',
		'balance' => 'int'
	];

	protected $fillable = [
		'user_id',
		'balance'
	];

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
