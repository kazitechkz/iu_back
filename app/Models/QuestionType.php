<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class QuestionType
 * 
 * @property int $id
 * @property string $title_kk
 * @property string $title_ru
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * 
 * @property Collection|Question[] $questions
 *
 * @package App\Models
 */
class QuestionType extends Model
{
	use SoftDeletes;
	protected $table = 'question_types';

	protected $fillable = [
		'title_kk',
		'title_ru'
	];

	public function questions()
	{
		return $this->hasMany(Question::class, 'type_id');
	}
}
