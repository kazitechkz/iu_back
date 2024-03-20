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
 * Class CareerQuizGroup
 *
 * @property int $id
 * @property string $title_ru
 * @property string $title_kk
 * @property string|null $title_en
 * @property string $description_ru
 * @property string $description_kk
 * @property string|null $description_en
 * @property string|null $email
 * @property string|null $phone
 * @property string|null $address
 * @property int $price
 * @property int $old_price
 * @property string $currency
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Collection|CareerQuizAuthor[] $career_quiz_authors
 * @property Collection|CareerQuiz[] $career_quizzes
 *
 * @package App\Models
 */
class CareerQuizGroup extends Model
{
    use CRUD;

    protected $table = 'career_quiz_groups';

	protected $casts = [
		'price' => 'int',
        'old_price'=>'int',
	];

	protected $fillable = [
		'title_ru',
		'title_kk',
		'title_en',
		'description_ru',
		'description_kk',
		'description_en',
		'email',
		'phone',
		'address',
		'price',
        'old_price',
		'currency'
	];

	public function career_quiz_authors()
	{
		return $this->hasMany(CareerQuizAuthor::class, 'group_id');
	}

	public function career_quizzes()
	{
		return $this->hasMany(CareerQuiz::class, 'group_id');
	}
}
