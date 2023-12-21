<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use App\Traits\CRUD;
use Illuminate\Database\Eloquent\Model;

/**
 * Class BattleBet
 *
 * @property int $id
 * @property int $battle_id
 * @property int $owner_id
 * @property int|null $guest_id
 * @property int $owner_bet
 * @property int $guest_bet
 * @property bool $is_used
 *
 * @property Battle $battle
 * @property User $user
 *
 * @package App\Models
 */
class BattleBet extends Model
{
    use CRUD;
	protected $table = 'battle_bets';
	public $timestamps = false;

	protected $casts = [
		'battle_id' => 'int',
		'owner_id' => 'int',
		'guest_id' => 'int',
		'owner_bet' => 'int',
		'guest_bet' => 'int',
		'is_used' => 'bool'
	];

	protected $fillable = [
		'battle_id',
		'owner_id',
		'guest_id',
		'owner_bet',
		'guest_bet',
		'is_used'
	];

	public function battle()
	{
		return $this->belongsTo(Battle::class);
	}

	public function owner()
	{
		return $this->belongsTo(User::class, 'owner_id','id');
	}
    public function guest()
    {
        return $this->belongsTo(User::class, 'guest_id','id');
    }
}
