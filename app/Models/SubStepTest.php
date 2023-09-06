<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use App\Traits\CRUD;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class SubStepTest
 *
 * @property int $id
 * @property int $sub_step_id
 * @property int $sub_question_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property SubQuestion $sub_question
 * @property SubStep $sub_step
 *
 * @package App\Models
 */
class SubStepTest extends Model
{
    use CRUD;
	protected $table = 'sub_step_tests';

	protected $casts = [
		'sub_step_id' => 'int',
		'sub_question_id' => 'int'
	];

	protected $fillable = [
		'sub_step_id',
		'sub_question_id'
	];

	public function sub_question(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
		return $this->belongsTo(SubQuestion::class);
	}

	public function sub_step(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
		return $this->belongsTo(SubStep::class);
	}
}
