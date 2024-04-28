<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class UserSurvey
 * 
 * @property int $id
 * @property int $survey_id
 * @property int $user_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Survey $survey
 * @property User $user
 *
 * @package App\Models
 */
class UserSurvey extends Model
{
	protected $table = 'user_surveys';

	protected $casts = [
		'survey_id' => 'int',
		'user_id' => 'int'
	];

	protected $fillable = [
		'survey_id',
		'user_id'
	];

	public function survey()
	{
		return $this->belongsTo(Survey::class);
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
