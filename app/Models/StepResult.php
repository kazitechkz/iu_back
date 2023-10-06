<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class StepResult
 *
 * @property int $id
 * @property int $step_id
 * @property int $user_id
 * @property string|null $user_point
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Step $step
 * @property User $user
 *
 * @package App\Models
 */
class StepResult extends Model
{
	protected $table = 'step_results';

	protected $casts = [
		'step_id' => 'int',
		'user_id' => 'int',
        'locale_id' => 'int'
	];

	protected $fillable = [
		'step_id',
		'user_id',
		'user_point',
        'locale_id'
	];

	public function step()
	{
		return $this->belongsTo(Step::class);
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
