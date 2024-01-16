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
 * Class CareerQuizFeature
 *
 * @property int $id
 * @property int|null $image_url
 * @property int $quiz_id
 * @property string $title_ru
 * @property string $title_kk
 * @property string|null $title_en
 * @property string $description_ru
 * @property string $description_kk
 * @property string|null $description_en
 * @property string $activity_ru
 * @property string $activity_kk
 * @property string|null $activity_en
 * @property string $prospect_ru
 * @property string $prospect_kk
 * @property string|null $prospect_en
 * @property string $meaning_ru
 * @property string $meaning_kk
 * @property string|null $meaning_en
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property File|null $file
 * @property CareerQuiz $career_quiz
 * @property Collection|CareerQuizQuestion[] $career_quiz_questions
 *
 * @package App\Models
 */
class CareerQuizFeature extends Model
{
    use CRUD;

    protected $table = 'career_quiz_features';

	protected $casts = [
		'image_url' => 'int',
		'quiz_id' => 'int'
	];

	protected $fillable = [
		'image_url',
		'quiz_id',
		'title_ru',
		'title_kk',
		'title_en',
		'description_ru',
		'description_kk',
		'description_en',
		'activity_ru',
		'activity_kk',
		'activity_en',
		'prospect_ru',
		'prospect_kk',
		'prospect_en',
		'meaning_ru',
		'meaning_kk',
		'meaning_en'
	];

	public function file()
	{
		return $this->belongsTo(File::class, 'image_url');
	}

	public function career_quiz()
	{
		return $this->belongsTo(CareerQuiz::class, 'quiz_id');
	}

	public function career_quiz_questions()
	{
		return $this->hasMany(CareerQuizQuestion::class, 'feature_id');
	}
}
