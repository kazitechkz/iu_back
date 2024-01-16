<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use App\Traits\CRUD;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CareerQuizAnswer
 *
 * @property int $id
 * @property int $quiz_id
 * @property string $title_ru
 * @property string $title_kk
 * @property string|null $title_en
 * @property int $value
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property CareerQuiz $career_quiz
 *
 * @package App\Models
 */
class CareerQuizAnswer extends Model
{
    use CRUD;

    protected $table = 'career_quiz_answers';

	protected $casts = [
		'quiz_id' => 'int',
		'value' => 'int'
	];

	protected $fillable = [
        'quiz_id',

        'title_ru',
        'title_kk',
        'title_en',
        'value'
	];

	public function career_quiz()
	{
		return $this->belongsTo(CareerQuiz::class, 'quiz_id');
	}
}
