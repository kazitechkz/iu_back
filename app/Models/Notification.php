<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use App\Traits\CRUD;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Notification
 *
 * @property int $id
 * @property int $type_id
 * @property int|null $class_id
 * @property int|null $owner_id
 * @property array|null $users
 * @property string $title
 * @property string $message
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property ClassroomGroup|null $classroom_group
 * @property User|null $user
 * @property NotificationType $notification_type
 *
 * @package App\Models
 */
class Notification extends Model
{
    use CRUD;
	protected $table = 'notifications';

	protected $casts = [
		'type_id' => 'int',
		'class_id' => 'int',
		'owner_id' => 'int',
		'users' => 'json'
	];

	protected $fillable = [
		'type_id',
		'class_id',
		'owner_id',
		'users',
		'title',
		'message'
	];

	public function classroom_group()
	{
		return $this->belongsTo(ClassroomGroup::class, 'class_id');
	}

	public function owner()
	{
		return $this->belongsTo(User::class, 'owner_id')->select([
            'id',
            "username",
            'name',
            'phone',
            'email',
            'image_url'
        ])->with("file");
	}

	public function notification_type()
	{
		return $this->belongsTo(NotificationType::class, 'type_id');
	}

	public function users()
	{
		return $this->belongsToMany(User::class, 'notification_user_status')
					->withPivot('id', 'is_read')
					->withTimestamps();
	}
}
