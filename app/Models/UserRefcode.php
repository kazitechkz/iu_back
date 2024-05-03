<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class UserRefcode
 * 
 * @property int $id
 * @property int $user_id
 * @property string $refcode
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property User $user
 *
 * @package App\Models
 */
class UserRefcode extends Model
{
	protected $table = 'user_refcodes';

	protected $casts = [
		'user_id' => 'int'
	];

	protected $fillable = [
		'user_id',
		'refcode'
	];

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
