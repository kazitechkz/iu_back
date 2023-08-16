<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class SingleSubjectTest
 *
 * @property int $id
 * @property int $subject_id
 * @property int|null $single_answer_questions_quantity
 * @property int|null $contextual_questions_quantity
 * @property int|null $multi_answer_questions_quantity
 * @property int $allotted_time
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 *
 * @property Subject $subject
 *
 * @package App\Models
 */
class SingleSubjectTest extends Model
{
	use SoftDeletes;
	protected $table = 'single_subject_tests';

	protected $casts = [
		'subject_id' => 'int',
		'single_answer_questions_quantity' => 'int',
		'contextual_questions_quantity' => 'int',
		'multi_answer_questions_quantity' => 'int',
		'allotted_time' => 'int'
	];

	protected $fillable = [
		'subject_id',
		'single_answer_questions_quantity',
		'contextual_questions_quantity',
		'multi_answer_questions_quantity',
		'allotted_time'
	];

	public function subject(): BelongsTo
    {
		return $this->belongsTo(Subject::class);
	}
}
