<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class SurveyAnswer
 * 
 * @property int $id
 * @property int $survey_id
 * @property int $user_id
 * @property int $survey_question_id
 * @property string $answer
 * @property string|null $input
 * @property string|null $wishes
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Survey $survey
 * @property SurveyQuestion $survey_question
 * @property User $user
 *
 * @package App\Models
 */
class SurveyAnswer extends Model
{
	protected $table = 'survey_answers';

	protected $casts = [
		'survey_id' => 'int',
		'user_id' => 'int',
		'survey_question_id' => 'int'
	];

	protected $fillable = [
		'survey_id',
		'user_id',
		'survey_question_id',
		'answer',
		'input',
		'wishes'
	];

	public function survey()
	{
		return $this->belongsTo(Survey::class);
	}

	public function survey_question()
	{
		return $this->belongsTo(SurveyQuestion::class);
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
