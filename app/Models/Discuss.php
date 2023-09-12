<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use App\Traits\CRUD;
use App\Traits\Language;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Discuss
 *
 * @property int $id
 * @property string $text
 * @property int|null $user_id
 * @property int|null $forum_id
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Forum|null $forum
 * @property User|null $user
 * @property Collection|DiscussRating[] $discuss_ratings
 *
 * @package App\Models
 */
class Discuss extends Model
{
	use SoftDeletes;
    use CRUD, Language;
	protected $table = 'discusses';

	protected $casts = [
		'user_id' => 'int',
		'forum_id' => 'int'
	];

	protected $fillable = [
		'text',
		'user_id',
		'forum_id'
	];

	public function forum()
	{
		return $this->belongsTo(Forum::class);
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function discuss_ratings()
	{
		return $this->hasMany(DiscussRating::class);
	}
}
