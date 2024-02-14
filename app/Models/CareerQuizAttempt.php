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
 * Class CareerQuizAttempt
 *
 * @property int $id
 * @property int $user_id
 * @property int $quiz_id
 * @property array $given_answers
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property CareerQuiz $career_quiz
 * @property User $user
 * @property Collection|CareerQuizAttemptResult[] $career_quiz_attempt_results
 *
 * @package App\Models
 */
class CareerQuizAttempt extends Model
{
    use CRUD;
	protected $table = 'career_quiz_attempts';

	protected $casts = [
		'user_id' => 'int',
		'quiz_id' => 'int',
		'given_answers' => 'json'
	];

	protected $fillable = [
		'user_id',
		'quiz_id',
		'given_answers'
	];

	public function career_quiz()
	{
		return $this->belongsTo(CareerQuiz::class, 'quiz_id');
	}

	public function user()
	{
        return $this->belongsTo(User::class,"user_id","id")->select([
            'id',
            "username",
            'name',
            'phone',
            'email',
            'image_url'
        ])->with("file");
	}

	public function career_quiz_attempt_results()
	{
		return $this->hasMany(CareerQuizAttemptResult::class, 'attempt_id')->orderBy("percentage","desc");
	}
}
