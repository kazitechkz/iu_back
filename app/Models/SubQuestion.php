<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class SubQuestion
 *
 * @property int $id
 * @property string $text
 * @property string $answer_a
 * @property string $answer_b
 * @property string $answer_c
 * @property string $answer_d
 * @property string $correct_answer
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Collection|SubStepTest[] $sub_step_tests
 *
 * @package App\Models
 */
class SubQuestion extends Model
{
	protected $table = 'sub_questions';

	protected $fillable = [
		'text',
		'answer_a',
		'answer_b',
		'answer_c',
		'answer_d',
		'correct_answer'
	];

	public function sub_step_tests(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
		return $this->hasMany(SubStepTest::class);
	}
}
