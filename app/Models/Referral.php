<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Referral
 *
 * @property int $id
 * @property int $referrer_id
 * @property int $referee_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property User $user
 * @property User $referral
 * @property PayboxOrder $orders
 *
 * @package App\Models
 */
class Referral extends Model
{
	protected $table = 'referrals';

	protected $casts = [
		'referrer_id' => 'int',
		'referee_id' => 'int'
	];

	protected $fillable = [
		'referrer_id',
		'referee_id'
	];

	public function user()
	{
		return $this->belongsTo(User::class, 'referrer_id', 'id');
	}

    public function referral(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'referee_id');
    }

    public function orders(): HasMany
    {
        return $this->hasMany(PayboxOrder::class, 'user_id', 'referee_id');
    }
}
