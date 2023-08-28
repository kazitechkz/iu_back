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
 * Class DiscussRating
 *
 * @property int $id
 * @property int|null $rating
 * @property int|null $user_id
 * @property int|null $discuss_id
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Discuss|null $discuss
 * @property User|null $user
 *
 * @package App\Models
 */
class DiscussRating extends Model
{
	use SoftDeletes;
    use CRUD;
	protected $table = 'discuss_rating';

	protected $casts = [
		'rating' => 'int',
		'user_id' => 'int',
		'discuss_id' => 'int',
        'forum_id'=>'int'
	];

	protected $fillable = [
		'rating',
		'user_id',
		'discuss_id',
        "forum_id"
	];

	public function discuss()
	{
		return $this->belongsTo(Discuss::class);
	}

    public function forum()
    {
        return $this->belongsTo(Forum::class);
    }

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
