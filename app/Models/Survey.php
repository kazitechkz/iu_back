<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Survey
 * 
 * @property int $id
 * @property string $title
 * @property bool $is_subscription
 * @property bool $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|SurveyAnswer[] $survey_answers
 * @property Collection|SurveyQuestion[] $survey_questions
 * @property Collection|User[] $users
 *
 * @package App\Models
 */
class Survey extends Model
{
	protected $table = 'surveys';

	protected $casts = [
		'is_subscription' => 'bool',
		'status' => 'bool'
	];

	protected $fillable = [
		'title',
		'is_subscription',
		'status'
	];

	public function survey_answers()
	{
		return $this->hasMany(SurveyAnswer::class);
	}

	public function survey_questions()
	{
		return $this->hasMany(SurveyQuestion::class);
	}

	public function users()
	{
		return $this->belongsToMany(User::class, 'user_surveys')
					->withPivot('id')
					->withTimestamps();
	}
}
