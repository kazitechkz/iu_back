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
 * Class ParticipantRating
 *
 * @property int $id
 * @property int $tutor_id
 * @property int $participant_id
 * @property int|null $rating
 * @property string|null $review
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property User $user
 * @property Tutor $tutor
 *
 * @package App\Models
 */
class ParticipantRating extends Model
{
    use CRUD;
	use SoftDeletes;
	protected $table = 'participant_ratings';

	protected $casts = [
		'tutor_id' => 'int',
		'participant_id' => 'int',
		'rating' => 'int'
	];

	protected $fillable = [
		'tutor_id',
		'participant_id',
		'rating',
		'review'
	];

	public function user()
	{
		return $this->belongsTo(User::class, 'participant_id');
	}

	public function tutor()
	{
		return $this->belongsTo(Tutor::class);
	}
}
