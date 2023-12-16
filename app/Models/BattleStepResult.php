<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use App\Traits\CRUD;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class BattleStepResult
 *
 * @property int $id
 * @property int $step_id
 * @property int|null $answered_user
 * @property Carbon $start_at
 * @property Carbon|null $end_at
 * @property bool $is_finished
 * @property int $result
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property User|null $user
 * @property BattleStep $battle_step
 *
 * @package App\Models
 */
class BattleStepResult extends Model
{
    use CRUD;
	protected $table = 'battle_step_results';

	protected $casts = [
		'step_id' => 'int',
		'answered_user' => 'int',
		'start_at' => 'datetime',
		'end_at' => 'datetime',
		'must_finished_at' => 'datetime',
		'is_finished' => 'bool',
		'result' => 'int'
	];

	protected $fillable = [
		'step_id',
		'answered_user',
		'start_at',
		'end_at',
		'must_finished_at',
		'is_finished',
		'result'
	];

	public function answered()
	{
		return $this->belongsTo(User::class, 'answered_user',"id")->select([
            'id',
            "username",
            'name',
            'phone',
            'email',
            'image_url'
        ])->with("file");
	}

	public function battle_step()
	{
		return $this->belongsTo(BattleStep::class, 'step_id');
	}
}
