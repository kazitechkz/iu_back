<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class LessonSchedule
 * 
 * @property int $id
 * @property int $tutor_id
 * @property Carbon $start_at
 * @property Carbon $end_at
 * @property float $price
 * @property int $amount
 * @property string $meeting_info
 * @property int|null $cancel_from
 * @property bool $is_cancelled
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property LessonSchedule|null $lesson_schedule
 * @property Tutor $tutor
 * @property Collection|LessonComplaint[] $lesson_complaints
 * @property Collection|LessonScheduleParticipant[] $lesson_schedule_participants
 * @property Collection|LessonSchedule[] $lesson_schedules
 *
 * @package App\Models
 */
class LessonSchedule extends Model
{
	use SoftDeletes;
	protected $table = 'lesson_schedules';

	protected $casts = [
		'tutor_id' => 'int',
		'start_at' => 'datetime',
		'end_at' => 'datetime',
		'price' => 'float',
		'amount' => 'int',
		'cancel_from' => 'int',
		'is_cancelled' => 'bool'
	];

	protected $fillable = [
		'tutor_id',
		'start_at',
		'end_at',
		'price',
		'amount',
		'meeting_info',
		'cancel_from',
		'is_cancelled'
	];

	public function lesson_schedule()
	{
		return $this->belongsTo(LessonSchedule::class, 'cancel_from');
	}

	public function tutor()
	{
		return $this->belongsTo(Tutor::class);
	}

	public function lesson_complaints()
	{
		return $this->hasMany(LessonComplaint::class, 'schedule_id');
	}

	public function lesson_schedule_participants()
	{
		return $this->hasMany(LessonScheduleParticipant::class, 'schedule_id');
	}

	public function lesson_schedules()
	{
		return $this->hasMany(LessonSchedule::class, 'cancel_from');
	}
}
