<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class UserStepsBonu
 *
 * @property int $user_id
 * @property int $step_id
 *
 * @property Step $step
 * @property User $user
 *
 * @package App\Models
 */
class UserStepsBonus extends Model
{
	protected $table = 'user_steps_bonus';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'user_id' => 'int',
		'step_id' => 'int'
	];

	protected $fillable = [
		'user_id',
		'step_id'
	];

	public function step(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
		return $this->belongsTo(Step::class);
	}

	public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
		return $this->belongsTo(User::class);
	}
}
