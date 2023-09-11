<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class LessonComplaint
 * 
 * @property int $id
 * @property int|null $tutor_id
 * @property int|null $participant_id
 * @property int|null $schedule_id
 * @property string $complaint
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property User|null $user
 * @property LessonSchedule|null $lesson_schedule
 * @property Tutor|null $tutor
 *
 * @package App\Models
 */
class LessonComplaint extends Model
{
	protected $table = 'lesson_complaints';

	protected $casts = [
		'tutor_id' => 'int',
		'participant_id' => 'int',
		'schedule_id' => 'int'
	];

	protected $fillable = [
		'tutor_id',
		'participant_id',
		'schedule_id',
		'complaint'
	];

	public function user()
	{
		return $this->belongsTo(User::class, 'participant_id');
	}

	public function lesson_schedule()
	{
		return $this->belongsTo(LessonSchedule::class, 'schedule_id');
	}

	public function tutor()
	{
		return $this->belongsTo(Tutor::class);
	}
}
