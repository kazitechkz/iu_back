<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use App\Traits\CRUD;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class SubTournamentResult
 *
 * @property int $id
 * @property int $user_id
 * @property int $sub_tournament_id
 * @property int $point
 * @property int $time
 * @property int $attempt_id
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Attempt $attempt
 * @property SubTournament $sub_tournament
 * @property User $user
 *
 * @package App\Models
 */
class SubTournamentResult extends Model
{
    use CRUD;
	use SoftDeletes;
	protected $table = 'sub_tournament_results';

	protected $casts = [
		'user_id' => 'int',
		'sub_tournament_id' => 'int',
		'point' => 'int',
		'time' => 'int',
		'attempt_id' => 'int'
	];

	protected $fillable = [
		'user_id',
		'sub_tournament_id',
		'point',
		'time',
		'attempt_id'
	];

	public function attempt()
	{
		return $this->belongsTo(Attempt::class);
	}

	public function sub_tournament()
	{
		return $this->belongsTo(SubTournament::class);
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
