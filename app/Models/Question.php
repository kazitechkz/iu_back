<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use App\Traits\CRUD;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Question
 *
 * @property int $id
 * @property string|null $context
 * @property string $text
 * @property string $answer_a
 * @property string $answer_b
 * @property string $answer_c
 * @property string $answer_d
 * @property string $answer_e
 * @property string|null $answer_f
 * @property string|null $answer_g
 * @property string|null $answer_h
 * @property string $correct_answers
 * @property string|null $prompt
 * @property string|null $prompt_image
 * @property int|null $locale_id
 * @property string|null $explanation
 * @property string|null $explanation_image
 * @property int|null $subject_id
 * @property int $type_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 *
 * @property Locale|null $locale
 * @property Subject|null $subject
 * @property QuestionType $question_type
 *
 * @package App\Models
 */
class Question extends Model
{
	use SoftDeletes, CRUD;
	protected $table = 'questions';

	protected $casts = [
		'locale_id' => 'int',
		'subject_id' => 'int',
		'type_id' => 'int'
	];

	protected $fillable = [
		'context',
		'text',
		'answer_a',
		'answer_b',
		'answer_c',
		'answer_d',
		'answer_e',
		'answer_f',
		'answer_g',
		'answer_h',
		'correct_answers',
		'prompt',
		'prompt_image',
		'locale_id',
		'explanation',
		'explanation_image',
		'subject_id',
		'type_id'
	];

	public function locale(): BelongsTo
    {
		return $this->belongsTo(Locale::class);
	}

	public function subject(): BelongsTo
    {
		return $this->belongsTo(Subject::class);
	}

	public function question_type(): BelongsTo
    {
		return $this->belongsTo(QuestionType::class, 'type_id');
	}
}