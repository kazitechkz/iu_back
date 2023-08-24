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
 * Class SubTournament
 *
 * @property int $id
 * @property int $tournament_id
 * @property int $step_id
 * @property int $question_quantity
 * @property int $max_point
 * @property int $single_question_quantity
 * @property int $multiple_question_quantity
 * @property int $context_question_quantity
 * @property int $time
 * @property Carbon $start_at
 * @property Carbon $end_at
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property TournamentStep $tournament_step
 * @property Tournament $tournament
 * @property Collection|SubTournamentResult[] $sub_tournament_results
 * @property Collection|SubTournamentRival[] $sub_tournament_rivals
 * @property Collection|SubTournamentWinner[] $sub_tournament_winners
 * @property Collection|SubtournamentParticipant[] $subtournament_participants
 *
 * @package App\Models
 */
class SubTournament extends Model
{
    use CRUD;
	use SoftDeletes;
	protected $table = 'sub_tournaments';

	protected $casts = [
		'tournament_id' => 'int',
		'step_id' => 'int',
		'question_quantity' => 'int',
		'max_point' => 'int',
		'single_question_quantity' => 'int',
		'multiple_question_quantity' => 'int',
		'context_question_quantity' => 'int',
		'time' => 'int',
		'start_at' => 'datetime',
		'end_at' => 'datetime'
	];

	protected $fillable = [
		'tournament_id',
		'step_id',
		'question_quantity',
		'max_point',
		'single_question_quantity',
		'multiple_question_quantity',
		'context_question_quantity',
		'time',
		'start_at',
		'end_at'
	];

	public function tournament_step()
	{
		return $this->belongsTo(TournamentStep::class, 'step_id');
	}

	public function tournament()
	{
		return $this->belongsTo(Tournament::class);
	}

	public function sub_tournament_results()
	{
		return $this->hasMany(SubTournamentResult::class);
	}

	public function sub_tournament_rivals()
	{
		return $this->hasMany(SubTournamentRival::class);
	}

	public function sub_tournament_winners()
	{
		return $this->hasMany(SubTournamentWinner::class);
	}

	public function subtournament_participants()
	{
		return $this->hasMany(SubtournamentParticipant::class);
	}
}
