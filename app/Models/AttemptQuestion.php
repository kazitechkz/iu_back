<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use App\Traits\CRUD;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class AttemptQuestion
 *
 * @property int $id
 * @property int $attempt_subject_id
 * @property int $question_id
 * @property int $point
 * @property bool $is_right
 * @property string|null $user_answer
 * @property bool $is_answered
 * @property bool $is_skipped
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property AttemptSubject $attempt_subject
 * @property Question $question
 *
 * @package App\Models
 */
class AttemptQuestion extends Model
{
    use CRUD;
	protected $table = 'attempt_questions';

	protected $casts = [
		'attempt_subject_id' => 'int',
		'question_id' => 'int',
		'point' => 'int',
		'is_right' => 'bool',
		'is_answered' => 'bool',
		'is_skipped' => 'bool'
	];

	protected $fillable = [
		'attempt_subject_id',
		'question_id',
		'point',
		'is_right',
		'user_answer',
		'is_answered',
		'is_skipped'
	];

	public function attempt_subject()
	{
		return $this->belongsTo(AttemptSubject::class);
	}

	public function question()
	{
		return $this->belongsTo(Question::class);
	}
}
