<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class LessonRating
 * 
 * @property int $id
 * @property int $participant_id
 * @property int|null $rating
 * @property string|null $review
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property User $user
 *
 * @package App\Models
 */
class LessonRating extends Model
{
	use SoftDeletes;
	protected $table = 'lesson_ratings';

	protected $casts = [
		'participant_id' => 'int',
		'rating' => 'int'
	];

	protected $fillable = [
		'participant_id',
		'rating',
		'review'
	];

	public function user()
	{
		return $this->belongsTo(User::class, 'participant_id');
	}
}
