<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use App\Traits\CRUD;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class TournamentStep
 *
 * @property int $id
 * @property string $title_ru
 * @property string $title_kk
 * @property string|null $title_en
 * @property int $max_participants
 * @property bool $is_first
 * @property bool $is_last
 * @property int|null $prev_id
 * @property int|null $next_id
 * @property int $order
 * @property bool $is_playoff
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property TournamentStep|null $tournament_step
 * @property Collection|SubTournament[] $sub_tournaments
 * @property Collection|TournamentStep[] $tournament_steps
 *
 * @package App\Models
 */
class TournamentStep extends Model
{
    use CRUD;
	use SoftDeletes;
	protected $table = 'tournament_steps';

	protected $casts = [
		'max_participants' => 'int',
		'is_first' => 'bool',
		'is_last' => 'bool',
		'prev_id' => 'int',
		'next_id' => 'int',
		'order' => 'int',
		'is_playoff' => 'bool'
	];

	protected $fillable = [
		'title_ru',
		'title_kk',
		'title_en',
		'max_participants',
		'is_first',
		'is_last',
		'prev_id',
		'next_id',
		'order',
		'is_playoff'
	];

	public function tournament_step()
	{
		return $this->belongsTo(TournamentStep::class, 'prev_id');
	}

	public function sub_tournaments()
	{
		return $this->hasMany(SubTournament::class, 'step_id');
	}

	public function tournament_steps()
	{
		return $this->hasMany(TournamentStep::class, 'prev_id');
	}
}
