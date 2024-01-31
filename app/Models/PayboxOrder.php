<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use App\Traits\CRUD;
use Bpuig\Subby\Models\Plan;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class PayboxOrder
 *
 * @property int $id
 * @property int $user_id
 * @property string $order_id
 * @property string $price
 * @property int $status
 * @property string|null $description
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property User $user
 *
 * @package App\Models
 */
class PayboxOrder extends Model
{
    use CRUD;
	protected $table = 'paybox_orders';

	protected $casts = [
		'user_id' => 'int',
		'status' => 'int',
        'plans' => 'json',
        'subjects' => 'json'
	];

	protected $fillable = [
		'user_id',
		'order_id',
		'price',
        'plans',
		'status',
        'subjects',
		'description'
	];

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
