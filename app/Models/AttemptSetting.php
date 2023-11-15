<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use App\Traits\CRUD;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
		'owner_id' => 'int',
		'settings' => 'json',
		'locale_id' => 'int',
		'subject_id' => 'int',
		'time' => 'int',
		'point' => 'int',
        'users' => 'array',
	];

	protected $fillable = [
        "subject_id",
		'promo_code',
		'class_id',
		'users',
		'owner',
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

	public function owner()
	{
		return $this->belongsTo(User::class,"owner_id","id")->select([
            'id',
            "username",
            'name',
            'phone',
            'email',
            'image_url'
        ])->with("file");
	}
    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function isUserIncluded(){
        if ($this->users){
            $users = json_decode($this->users,true);
            return in_array(auth()->guard("api")->id(),$users);
        }
        return false;
    }

    public function attempt_settings_results():HasMany{
        return $this->hasMany(AttemptSettingsResult::class,"setting_id","id");
    }
}