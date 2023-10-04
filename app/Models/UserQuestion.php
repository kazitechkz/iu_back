<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use App\Traits\CRUD;
use Illuminate\Database\Eloquent\Model;

/**
 * Class UserQuestion
 *
 * @property int $id
 * @property int $user_id
 * @property int $question_id
 *
 * @property Question $question
 * @property User $user
 *
 * @package App\Models
 */
class UserQuestion extends Model
{
    use CRUD;
	protected $table = 'user_questions';
	public $timestamps = false;

	protected $casts = [
		'user_id' => 'int',
		'question_id' => 'int'
	];

	protected $fillable = [
		'user_id',
		'question_id'
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
