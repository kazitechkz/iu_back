<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use App\Helpers\HasManyJSON;
use App\Traits\CRUD;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
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
 * @property AttemptSettingsResult|null $attempt_settings_results
 *
 * @package App\Models
 */
class AttemptSetting extends Model
{
    use CRUD;
    use \Staudenmeir\EloquentJsonRelations\HasJsonRelationships;
    protected $table = 'attempt_settings';

    protected $casts = [
        'class_id' => 'int',
        'owner_id' => 'int',
        'settings' => 'json',
        'locale_id' => 'int',
        'subject_id' => 'int',
        'time' => 'int',
        'point' => 'int',
        'users' => 'json',
    ];

    protected $fillable = [
        "subject_id",
        'promo_code',
        'class_id',
        'users',
        'owner_id',
        'settings',
        'locale_id',
        'time',
        'hidden_fields',
        'point'
    ];
    protected function users(): Attribute {
        return Attribute::make(
            get: function($value){
                $ids = json_decode($value);
                if(!is_array($ids)){
                    return [];
                }
                return User::with('attempt_settings_result')->whereIn('id', $ids)->get();
            },
        );
    }

    public function getUsers($attempt_id)
    {
        return User::with(['attempt_settings_result' => function ($query) use ($attempt_id) {
            return $query->where('setting_id', $attempt_id);
        }])->whereIn('id', $this->users->pluck('id')->toArray())->get();
    }
    public function classroom_group()
    {
        return $this->belongsTo(ClassroomGroup::class, 'class_id', 'id');
    }

    public function locale()
    {
        return $this->belongsTo(Locale::class);
    }

    public function owner()
    {
        return $this->belongsTo(User::class, "owner_id", "id")->select([
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

    public function isUserIncluded(): bool
    {
        if ($this->users) {
            return in_array(auth()->guard("api")->id(), $this->users->pluck('id')->toArray());
        }
        return false;
    }

    public function attempt_settings_results(): HasMany
    {
        return $this->hasMany(AttemptSettingsResult::class, "setting_id", "id");
    }

}
