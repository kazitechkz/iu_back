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
 * Class Attempt
 *
 * @property int $id
 * @property int $type_id
 * @property int $user_id
 * @property int $locale_id
 * @property Carbon $start_at
 * @property Carbon|null $end_at
 * @property int $max_points
 * @property int $points
 * @property int $time
 * @property int $time_left
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Locale $locale
 * @property AttemptType $attempt_type
 * @property User $user
 * @property Collection|Subject[] $subjects
 * @property Collection|SubTournamentResult[] $sub_tournament_results
 *
 * @package App\Models
 */
class Attempt extends Model
{
	use SoftDeletes;
    use CRUD;
	protected $table = 'attempts';

	protected $casts = [
		'type_id' => 'int',
		'user_id' => 'int',
		'locale_id' => 'int',
		'start_at' => 'datetime',
		'end_at' => 'datetime',
		'max_points' => 'int',
		'points' => 'int',
		'time' => 'int',
		'time_left' => 'int'
	];

	protected $fillable = [
		'type_id',
		'user_id',
		'locale_id',
		'start_at',
		'end_at',
		'max_points',
		'points',
		'time',
		'time_left'
	];

	public function locale()
	{
		return $this->belongsTo(Locale::class);
	}

	public function attempt_type()
	{
		return $this->belongsTo(AttemptType::class, 'type_id');
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function subjects()
	{
		return $this->belongsToMany(Subject::class, 'attempt_subjects')
					->withPivot('id')
					->withTimestamps();
	}

	public function sub_tournament_results()
	{
		return $this->hasMany(SubTournamentResult::class);
	}
}
