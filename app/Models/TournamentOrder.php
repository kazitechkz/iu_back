<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TournamentOrder
 * 
 * @property int $id
 * @property int $user_id
 * @property int $order_id
 * @property int $price
 * @property int $tournament_id
 * @property bool $status
 * @property string $description
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Tournament $tournament
 * @property User $user
 *
 * @package App\Models
 */
class TournamentOrder extends Model
{
	protected $table = 'tournament_orders';

	protected $casts = [
		'user_id' => 'int',
		'order_id' => 'int',
		'price' => 'int',
		'tournament_id' => 'int',
		'status' => 'bool'
	];

	protected $fillable = [
		'user_id',
		'order_id',
		'price',
		'tournament_id',
		'status',
		'description'
	];

	public function tournament()
	{
		return $this->belongsTo(Tournament::class);
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
