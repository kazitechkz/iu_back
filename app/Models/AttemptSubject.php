<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use App\Traits\CRUD;
use App\Traits\Language;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class AttemptSubject
 *
 * @property int $id
 * @property int $attempt_id
 * @property int $subject_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Attempt $attempt
 * @property Subject $subject
 * @property Collection|AttemptQuestion[] $attempt_questions
 *
 * @package App\Models
 */
class AttemptSubject extends Model
{
    use CRUD, Language;
	protected $table = 'attempt_subjects';

	protected $casts = [
		'attempt_id' => 'int',
		'subject_id' => 'int'
	];

	protected $fillable = [
		'attempt_id',
		'subject_id'
	];

	public function attempt()
	{
		return $this->belongsTo(Attempt::class);
	}

	public function subject()
	{
		return $this->belongsTo(Subject::class);
	}

	public function attempt_questions()
	{
		return $this->hasMany(AttemptQuestion::class);
	}
}
