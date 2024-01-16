<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use App\Traits\CRUD;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CareerQuizCreator
 *
 * @property int $id
 * @property int $quiz_id
 * @property int $author_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property CareerQuizAuthor $career_quiz_author
 * @property CareerQuiz $career_quiz
 *
 * @package App\Models
 */
class CareerQuizCreator extends Model
{
    use CRUD;

    protected $table = 'career_quiz_creator';

	protected $casts = [
		'quiz_id' => 'int',
		'author_id' => 'int'
	];

	protected $fillable = [
		'quiz_id',
		'author_id'
	];

	public function career_quiz_author()
	{
		return $this->belongsTo(CareerQuizAuthor::class, 'author_id');
	}

	public function career_quiz()
	{
		return $this->belongsTo(CareerQuiz::class, 'quiz_id');
	}
}
