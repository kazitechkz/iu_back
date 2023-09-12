<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class SubStepResult
 *
 * @property int $id
 * @property int $sub_step_id
 * @property int $user_id
 * @property string|null $user_point
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property SubStep $sub_step
 * @property User $user
 *
 * @package App\Models
 */
class SubStepResult extends Model
{
	protected $table = 'sub_step_results';

	protected $casts = [
		'sub_step_id' => 'int',
		'user_id' => 'int'
	];

	protected $fillable = [
		'sub_step_id',
		'user_id',
		'user_point'
	];

	public function sub_step(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
		return $this->belongsTo(SubStep::class);
	}

	public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
		return $this->belongsTo(User::class);
	}
}
