<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CashWithdrawal
 * 
 * @property int $id
 * @property int $user_id
 * @property int $cash_id
 * @property bool $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Cash $cash
 * @property User $user
 *
 * @package App\Models
 */
class CashWithdrawal extends Model
{
	protected $table = 'cash_withdrawals';

	protected $casts = [
		'user_id' => 'int',
		'cash_id' => 'int',
		'status' => 'bool'
	];

	protected $fillable = [
		'user_id',
		'cash_id',
		'status'
	];

	public function cash()
	{
		return $this->belongsTo(Cash::class);
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
