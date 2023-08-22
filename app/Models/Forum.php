<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use App\Traits\CRUD;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Forum
 *
 * @property int $id
 * @property string $text
 * @property string $attachment
 * @property int|null $user_id
 * @property int|null $subject_id
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Subject|null $subject
 * @property User|null $user
 * @property Collection|Discuss[] $discusses
 *
 * @package App\Models
 */
class Forum extends Model
{
	use SoftDeletes;
    use CRUD;
	protected $table = 'forums';

	protected $casts = [
		'user_id' => 'int',
		'subject_id' => 'int'
	];

	protected $fillable = [
		'text',
		'attachment',
		'user_id',
		'subject_id'
	];

	public function subject()
	{
		return $this->belongsTo(Subject::class);
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function discusses()
	{
		return $this->hasMany(Discuss::class);
	}
}
