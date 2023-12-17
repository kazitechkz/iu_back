<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use App\Traits\CRUD;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class BattleStepQuestion
 *
 * @property int $id
 * @property int $step_id
 * @property int $question_id
 * @property string $answer
 * @property bool $is_right
 * @property int $point
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Question $question
 * @property BattleStep $battle_step
 *
 * @package App\Models
 */
class BattleStepQuestion extends Model
{
    use CRUD;
	protected $table = 'battle_step_questions';

	protected $casts = [
		'step_id' => 'int',
		'question_id' => 'int',
		'user_id' => 'int',
		'is_right' => 'bool',
		'is_answered' => 'bool',
		'point' => 'int'
	];

	protected $fillable = [
		'step_id',
		'question_id',
		'user_id',
		'answer',
        'right_answer',
		'is_right',
		'is_answered',
		'point'
	];

	public function question()
	{
		return $this->belongsTo(Question::class);
	}
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id',"id")->select([
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
