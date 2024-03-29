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
 * Class CareerQuiz
 *
 * @property int $id
 * @property int $group_id
 * @property int|null $image_url
 * @property string $title_ru
 * @property string $title_kk
 * @property string|null $title_en
 * @property string $description_ru
 * @property string $description_kk
 * @property string|null $description_en
 * @property string $rule_ru
 * @property string $rule_kk
 * @property string|null $rule_en
 * @property int $price
 * @property int $old_price
 * @property int $order
 * @property string $currency
 * @property string $code
 * @property boolean $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property CareerQuizGroup $career_quiz_group
 * @property File|null $file
 * @property Collection|CareerQuizAnswer[] $career_quiz_answers
 * @property Collection|CareerQuizCreator[] $career_quiz_creators
 * @property Collection|CareerQuizFeature[] $career_quiz_features
 * @property Collection|CareerQuizQuestion[] $career_quiz_questions
 *
 * @package App\Models
 */
class CareerQuiz extends Model
{
    use CRUD;
	protected $table = 'career_quizzes';

	protected $casts = [
		'group_id' => 'int',
		'image_url' => 'int',
		'price' => 'int',
        'old_price'=>'int',
        'order'=>'int',
        'status'=>'boolean',
	];

	protected $fillable = [
		'group_id',
		'image_url',
		'title_ru',
		'title_kk',
		'title_en',
		'description_ru',
		'description_kk',
		'description_en',
		'rule_ru',
		'rule_kk',
		'rule_en',
		'price',
        'old_price',
        'order',
		'currency',
        "code",
        "status",
	];

	public function career_quiz_group()
	{
		return $this->belongsTo(CareerQuizGroup::class, 'group_id');
	}

	public function file()
	{
		return $this->belongsTo(File::class, 'image_url');
	}

	public function career_quiz_answers()
	{
		return $this->hasMany(CareerQuizAnswer::class, 'quiz_id');
	}

	public function career_quiz_creators()
	{
		return $this->hasMany(CareerQuizCreator::class, 'quiz_id');
	}

	public function career_quiz_features()
	{
		return $this->hasMany(CareerQuizFeature::class, 'quiz_id');
	}

	public function career_quiz_questions()
	{
		return $this->hasMany(CareerQuizQuestion::class, 'quiz_id');
	}
}
