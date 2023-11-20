<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use App\Traits\CRUD;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class NotificationType
 *
 * @property int $id
 * @property string $value
 * @property string $title_ru
 * @property string $title_kk
 * @property string|null $title_en
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Collection|Notification[] $notifications
 *
 * @package App\Models
 */
class NotificationType extends Model
{
    use CRUD;
	protected $table = 'notification_types';

	protected $fillable = [
		'value',
		'title_ru',
		'title_kk',
		'title_en'
	];

	public function notifications()
	{
		return $this->hasMany(Notification::class, 'type_id');
	}
}
