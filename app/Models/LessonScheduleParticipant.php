<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class LessonScheduleParticipant
 * 
 * @property int $id
 * @property int $participant_id
 * @property int $schedule_id
 * @property bool $is_presented
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property User $user
 * @property LessonSchedule $lesson_schedule
 *
 * @package App\Models
 */
class LessonScheduleParticipant extends Model
{
	use SoftDeletes;
	protected $table = 'lesson_schedule_participants';

	protected $casts = [
		'participant_id' => 'int',
		'schedule_id' => 'int',
		'is_presented' => 'bool'
	];

	protected $fillable = [
		'participant_id',
		'schedule_id',
		'is_presented'
	];

	public function user()
	{
		return $this->belongsTo(User::class, 'participant_id');
	}

	public function lesson_schedule()
	{
		return $this->belongsTo(LessonSchedule::class, 'schedule_id');
	}
}
