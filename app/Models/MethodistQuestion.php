<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use App\Traits\CRUD;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class MethodistQuestion
 *
 * @property int $id
 * @property int|null $user_id
 * @property int|null $question
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property User|null $user
 *
 * @package App\Models
 */
class MethodistQuestion extends Model
{
	protected $table = 'methodist_question';
    use CRUD;
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
		return $this->belongsTo(Question::class, 'question_id');
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
