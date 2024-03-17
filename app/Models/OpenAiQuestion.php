<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use App\Traits\CRUD;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class OpenAiQuestion
 *
 * @property int $id
 * @property int $question_id
 * @property int $user_id
 * @property string $answer
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Question $question
 * @property User $user
 *
 * @package App\Models
 */
class OpenAiQuestion extends Model
{
    use CRUD;
	protected $table = 'open_ai_questions';

	protected $casts = [
		'question_id' => 'int',
		'user_id' => 'int'
	];

	protected $fillable = [
		'question_id',
		'user_id',
		'answer'
	];

	public function question()
	{
		return $this->belongsTo(Question::class);
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
