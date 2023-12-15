<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use App\Traits\CRUD;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class BattleStep
 *
 * @property int $id
 * @property string $promo_code
 * @property int $battle_id
 * @property int $subject_id
 * @property int|null $current_user
 * @property bool $is_finished
 * @property bool $is_current
 * @property bool $is_last
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Battle $battle
 * @property User|null $user
 * @property Subject $subject
 * @property Collection|Question[] $questions
 * @property Collection|BattleStepResult[] $battle_step_results
 *
 * @package App\Models
 */
class BattleStep extends Model
{
    use CRUD;
	protected $table = 'battle_steps';

	protected $casts = [
		'battle_id' => 'int',
		'subject_id' => 'int',
		'current_user' => 'int',
		'is_finished' => 'bool',
		'is_current' => 'bool',
		'is_last' => 'bool'
	];

	protected $fillable = [
		'promo_code',
		'battle_id',
		'subject_id',
		'current_user',
		'is_finished',
		'is_current',
        'order',
		'is_last'
	];

	public function battle()
	{
		return $this->belongsTo(Battle::class);
	}

	public function currentUser()
	{
        return $this->belongsTo(User::class, 'current_user',"id")->select([
            'id',
            "username",
            'name',
            'phone',
            'email',
            'image_url'
        ])->with("file");
	}

	public function subject()
	{
		return $this->belongsTo(Subject::class);
	}

	public function questions()
	{
		return $this->belongsToMany(Question::class, 'battle_step_questions', 'step_id')
					->withPivot('id', 'answer', 'is_right', 'point')
					->withTimestamps();
	}

    public function battle_step_questions() : HasMany
    {
        return $this->hasMany(BattleStepQuestion::class, 'step_id');
    }

	public function battle_step_results() : HasMany
	{
		return $this->hasMany(BattleStepResult::class, 'step_id');
	}
}
