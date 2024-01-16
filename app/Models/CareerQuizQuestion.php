<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use App\Traits\CRUD;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CareerQuizQuestion
 *
 * @property int $id
 * @property int $quiz_id
 * @property int $feature_id
 * @property string $question_ru
 * @property string $question_kk
 * @property string|null $question_en
 * @property string|null $context_ru
 * @property string|null $context_kk
 * @property string|null $context_en
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property CareerQuizFeature $career_quiz_feature
 * @property CareerQuiz $career_quiz
 *
 * @package App\Models
 */
class CareerQuizQuestion extends Model
{
    use CRUD;

    protected $table = 'career_quiz_questions';

	protected $casts = [
		'quiz_id' => 'int',
		'feature_id' => 'int'
	];

	protected $fillable = [
		'quiz_id',
		'feature_id',
		'question_ru',
		'question_kk',
		'question_en',
		'context_ru',
		'context_kk',
		'context_en'
	];

	public function career_quiz_feature()
	{
		return $this->belongsTo(CareerQuizFeature::class, 'feature_id');
	}

	public function career_quiz()
	{
		return $this->belongsTo(CareerQuiz::class, 'quiz_id');
	}
}
