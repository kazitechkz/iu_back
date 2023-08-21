<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Appeal
 * 
 * @property int $id
 * @property int|null $user_id
 * @property int|null $type_id
 * @property int|null $question_id
 * @property string|null $message
 * @property int $status
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Question|null $question
 * @property AppealType|null $appeal_type
 * @property User|null $user
 *
 * @package App\Models
 */
class Appeal extends Model
{
	use SoftDeletes;
	protected $table = 'appeals';

	protected $casts = [
		'user_id' => 'int',
		'type_id' => 'int',
		'question_id' => 'int',
		'status' => 'int'
	];

	protected $fillable = [
		'user_id',
		'type_id',
		'question_id',
		'message',
		'status'
	];

	public function question()
	{
		return $this->belongsTo(Question::class);
	}

	public function appeal_type()
	{
		return $this->belongsTo(AppealType::class, 'type_id');
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
