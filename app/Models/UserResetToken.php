<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use App\Traits\CRUD;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class UserResetToken
 *
 * @property int $id
 * @property int $user_id
 * @property string $email
 * @property string|null $phone
 * @property string $code
 * @property Carbon $expired_at
 * @property bool $is_used
 * @property string|null $addition_info
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property User $user
 *
 * @package App\Models
 */
class UserResetToken extends Model
{
    use CRUD;
	protected $table = 'user_reset_tokens';

	protected $casts = [
		'user_id' => 'int',
		'expired_at' => 'datetime',
		'is_used' => 'bool'
	];

	protected $fillable = [
		'user_id',
		'email',
		'phone',
		'code',
		'expired_at',
		'is_used',
		'addition_info'
	];

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
