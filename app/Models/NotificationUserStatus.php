<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use App\Traits\CRUD;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class NotificationUserStatus
 *
 * @property int $id
 * @property int $user_id
 * @property int $notification_id
 * @property bool $is_read
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Notification $notification
 * @property User $user
 *
 * @package App\Models
 */
class NotificationUserStatus extends Model
{
    use CRUD;
	protected $table = 'notification_user_status';

	protected $casts = [
		'user_id' => 'int',
		'notification_id' => 'int',
		'is_read' => 'bool'
	];

	protected $fillable = [
		'user_id',
		'notification_id',
		'is_read'
	];

	public function notification()
	{
		return $this->belongsTo(Notification::class);
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
