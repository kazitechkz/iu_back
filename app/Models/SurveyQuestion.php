<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use App\Traits\CRUD;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class SurveyQuestion
 *
 * @property int $id
 * @property int $survey_id
 * @property int $locale_id
 * @property string $text
 * @property string|null $answer_a
 * @property string|null $answer_b
 * @property string|null $answer_c
 * @property string|null $answer_d
 * @property string|null $answer_e
 * @property string|null $answer_f
 * @property string|null $own_answer
 * @property int $order
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Survey $survey
 * @property Collection|SurveyAnswer[] $survey_answers
 *
 * @package App\Models
 */
class SurveyQuestion extends Model
{
    use CRUD;
	protected $table = 'survey_questions';

	protected $casts = [
		'survey_id' => 'int',
		'locale_id' => 'int',
		'order' => 'int'
	];

	protected $fillable = [
		'survey_id',
		'locale_id',
		'text',
		'answer_a',
		'answer_b',
		'answer_c',
		'answer_d',
		'answer_e',
		'answer_f',
		'own_answer',
		'order'
	];

	public function survey()
	{
		return $this->belongsTo(Survey::class);
	}
	public function locale()
	{
		return $this->belongsTo(Locale::class);
	}

	public function survey_answers()
	{
		return $this->hasMany(SurveyAnswer::class);
	}
}
