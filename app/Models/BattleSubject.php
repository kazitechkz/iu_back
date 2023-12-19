<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use App\Traits\CRUD;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class BattleSubject
 *
 * @property int $id
 * @property int $step_id
 * @property int $user_id
 * @property array $subject_ids
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property BattleStep $battle_step
 * @property User $user
 *
 * @package App\Models
 */
class BattleSubject extends Model
{
    use CRUD;
	protected $table = 'battle_subjects';

	protected $casts = [
		'step_id' => 'int',
		'user_id' => 'int',
		'subject_ids' => 'json'
	];

	protected $fillable = [
		'step_id',
		'user_id',
		'subject_ids'
	];

	public function battle_step()
	{
		return $this->belongsTo(BattleStep::class, 'step_id');
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
