<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CareerCoupon
 *
 * @property int $id
 * @property int $user_id
 * @property int $order_id
 * @property int $career_quiz_id
 * @property int $career_group_id
 * @property bool $is_used
 * @property bool $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property CareerQuizGroup $career_quiz_group
 * @property CareerQuiz $career_quiz
 * @property User $user
 *
 * @package App\Models
 */
class CareerCoupon extends Model
{
	protected $table = 'career_coupons';
	protected $casts = [
		'user_id' => 'int',
		'order_id' => 'int',
		'career_quiz_id' => 'int',
		'career_group_id' => 'int',
		'is_used' => 'bool',
		'status' => 'bool'
	];
	protected $fillable = [
		'user_id',
		'order_id',
		'career_quiz_id',
		'career_group_id',
		'is_used',
		'status'
	];
    public $timestamps = true;

	public function career_quiz_group()
	{
		return $this->belongsTo(CareerQuizGroup::class, 'career_group_id');
	}

	public function career_quiz()
	{
		return $this->belongsTo(CareerQuiz::class);
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
