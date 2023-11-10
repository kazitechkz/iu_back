<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use App\Traits\CRUD;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class AttemptSetting
 *
 * @property int $id
 * @property string $promo_code
 * @property int|null $class_id
 * @property int|null $user_id
 * @property array $settings
 * @property int $locale_id
 * @property int $time
 * @property string|null $hidden_fields
 * @property int $point
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property ClassroomGroup|null $classroom_group
 * @property Locale $locale
 * @property User|null $user
 *
 * @package App\Models
 */
class AttemptSetting extends Model
{
    use CRUD;
	protected $table = 'attempt_settings';

	protected $casts = [
		'class_id' => 'int',
		'user_id' => 'int',
		'settings' => 'json',
		'locale_id' => 'int',
		'subject_id' => 'int',
		'time' => 'int',
		'point' => 'int'
	];

	protected $fillable = [
        "subject_id",
		'promo_code',
		'class_id',
		'user_id',
		'settings',
		'locale_id',
		'time',
		'hidden_fields',
		'point'
	];

	public function classroom_group()
	{
		return $this->belongsTo(ClassroomGroup::class, 'class_id');
	}

	public function locale()
	{
		return $this->belongsTo(Locale::class);
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}
    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
}
