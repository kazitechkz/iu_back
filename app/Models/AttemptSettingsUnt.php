<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use App\Traits\CRUD;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class AttemptSettingsUnt
 *
 * @property int $id
 * @property string $promo_code
 * @property int $locale_id
 * @property int|null $sender_id
 * @property int|null $class_id
 * @property array|null $users
 * @property array $subjects
 * @property array|null $settings
 * @property int $time
 * @property string|null $hidden_fields
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property ClassroomGroup|null $classroom_group
 * @property Locale $locale
 * @property User|null $user
 * @property Collection|AttemptSettingsResultsUnt[] $attempt_settings_results_unts
 *
 * @package App\Models
 */
class AttemptSettingsUnt extends Model
{
    use CRUD;
	protected $table = 'attempt_settings_unt';

	protected $casts = [
		'locale_id' => 'int',
		'sender_id' => 'int',
		'class_id' => 'int',
		'users' => 'json',
		'subjects' => 'json',
		'settings' => 'json',
		'time' => 'int'
	];

    protected function subjects(): Attribute {
        return Attribute::make(
            get: function($value){
                $ids = json_decode($value);
                if(!is_array($ids)){
                    return [];
                }
                return Subject::whereIn('id', $ids)->get();
            },
        );
    }

	protected $fillable = [
		'promo_code',
		'locale_id',
		'sender_id',
		'class_id',
		'users',
		'subjects',
		'settings',
		'time',
		'hidden_fields'
	];

	public function classroom_group()
	{
		return $this->belongsTo(ClassroomGroup::class, 'class_id');
	}

	public function locale()
	{
		return $this->belongsTo(Locale::class);
	}

	public function sender()
	{
		return $this->belongsTo(User::class, 'sender_id')->select([
            'id',
            "username",
            'name',
            'phone',
            'email',
            'image_url'
        ])->with("file");
	}
    public function isUserIncluded(): bool
    {
        if ($this->users){
            return in_array(auth()->guard("api")->id(),$this->users);
        }
        return false;
    }
	public function attempt_settings_results_unts()
	{
		return $this->hasMany(AttemptSettingsResultsUnt::class, 'setting_id');
	}
}
