<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use App\Traits\CRUD;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CareerQuizAttemptResult
 *
 * @property int $id
 * @property int $attempt_id
 * @property int $feature_id
 * @property int $points
 * @property float $percentage
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property CareerQuizAttempt $career_quiz_attempt
 * @property CareerQuizFeature $career_quiz_feature
 *
 * @package App\Models
 */
class CareerQuizAttemptResult extends Model
{
    use CRUD;
	protected $table = 'career_quiz_attempt_results';

	protected $casts = [
		'attempt_id' => 'int',
		'feature_id' => 'int',
		'points' => 'int',
		'percentage' => 'float'
	];

	protected $fillable = [
		'attempt_id',
		'feature_id',
		'points',
		'percentage'
	];

	public function career_quiz_attempt()
	{
		return $this->belongsTo(CareerQuizAttempt::class, 'attempt_id');
	}

	public function career_quiz_feature()
	{
		return $this->belongsTo(CareerQuizFeature::class, 'feature_id');
	}
}
