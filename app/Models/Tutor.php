<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Tutor
 * 
 * @property int $id
 * @property int $user_id
 * @property int|null $image_url
 * @property int|null $gender_id
 * @property string $phone
 * @property string $email
 * @property string $iin
 * @property Carbon $birth_date
 * @property string $bio
 * @property string $experience
 * @property array $skills
 * @property bool $is_proved
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Gender|null $gender
 * @property File|null $file
 * @property User $user
 * @property Collection|LessonComplaint[] $lesson_complaints
 * @property Collection|LessonSchedule[] $lesson_schedules
 * @property Collection|ParticipantRating[] $participant_ratings
 * @property Collection|TutorSkill[] $tutor_skills
 *
 * @package App\Models
 */
class Tutor extends Model
{
	protected $table = 'tutors';

	protected $casts = [
		'user_id' => 'int',
		'image_url' => 'int',
		'gender_id' => 'int',
		'birth_date' => 'datetime',
		'skills' => 'json',
		'is_proved' => 'bool'
	];

	protected $fillable = [
		'user_id',
		'image_url',
		'gender_id',
		'phone',
		'email',
		'iin',
		'birth_date',
		'bio',
		'experience',
		'skills',
		'is_proved'
	];

	public function gender()
	{
		return $this->belongsTo(Gender::class);
	}

	public function file()
	{
		return $this->belongsTo(File::class, 'image_url');
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function lesson_complaints()
	{
		return $this->hasMany(LessonComplaint::class);
	}

	public function lesson_schedules()
	{
		return $this->hasMany(LessonSchedule::class);
	}

	public function participant_ratings()
	{
		return $this->hasMany(ParticipantRating::class);
	}

	public function tutor_skills()
	{
		return $this->hasMany(TutorSkill::class);
	}
}
