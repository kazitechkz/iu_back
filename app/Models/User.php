<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Traits\CRUD;
use Bavix\Wallet\Interfaces\Wallet;
use Bavix\Wallet\Traits\HasWallet;
use Bpuig\Subby\Traits\HasSubscriptions;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Multicaret\Acquaintances\Traits\CanBeFollowed;
use Multicaret\Acquaintances\Traits\CanBeLiked;
use Multicaret\Acquaintances\Traits\CanBeRated;
use Multicaret\Acquaintances\Traits\CanFollow;
use Multicaret\Acquaintances\Traits\CanLike;
use Multicaret\Acquaintances\Traits\CanRate;
use Multicaret\Acquaintances\Traits\Friendable;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;
use Zorb\Promocodes\Traits\AppliesPromocode;
/**
 * Class User
 * @property Collection|AttemptSettingsResult[] $attempt_settings_result
 * @property Collection|AttemptSettingsResultsUnt[] $attempt_settings_unt_result
 *
 * @package App\Models
 */
class User extends Authenticatable implements Searchable,Wallet
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;
    use CRUD;
    use HasSubscriptions;
    use AppliesPromocode;
    use HasWallet;
    //Acquitance
    use Friendable;
    use CanFollow, CanBeFollowed;
    use CanLike, CanBeLiked;
    use CanRate, CanBeRated;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        "username",
        'name',
        'parent_name',
        'phone',
        'parent_phone',
        'email',
        'password',
        "birth_date",
        "image_url",
        "gender_id"
    ];
    protected $guard_name = 'web';
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'birth_date' => 'datetime',
        'password' => 'hashed',
    ];


    public function getSearchResult(): SearchResult
    {
        $url = route('user.edit', $this->id);
        return new SearchResult(
            $this,
            $this->username,
            $url
        );
    }

    public function file(): BelongsTo
    {
        return $this->belongsTo(File::class, 'image_url');
    }
    public function attempts()
    {
        return $this->hasMany(Attempt::class);
    }

    public function gender(): BelongsTo
    {
        return $this->belongsTo(Gender::class, 'gender_id');
    }

    public function classRooms():HasMany{
        return $this->hasMany(Classroom::class, 'student_id',"id");
    }

    public function inIsClassroom($class_id) : bool{
        return $this->hasMany(Classroom::class, 'student_id',"id")->where(["class_id" => $class_id])->exists();
    }

    public function attempt_settings_result(): BelongsTo
    {
        return $this->belongsTo(AttemptSettingsResult::class, 'id', 'user_id');
    }

    public function attempt_settings_unt_result(): BelongsTo
    {
        return $this->belongsTo(AttemptSettingsResultsUnt::class, 'id', 'user_id');
    }

    public function stats_by_questions(): HasMany
    {
        return $this->hasMany(MethodistQuestion::class, 'user_id');
    }

    public function stats_by_contents(): HasMany
    {
        return $this->hasMany(MethodistContentStat::class, 'created_user');
    }

    public function stats_by_questions_kk()
    {
        return $this->stats_by_questions()->whereHas('question', function ($q){$q->where('locale_id',1);});
    }
    public function stats_by_questions_ru()
    {
        return $this->stats_by_questions()->whereHas('question', function ($q){$q->where('locale_id',2);});
    }

    public function hubs()
    {
        return $this->hasMany(UserHub::class);
    }

    public function isKundelik(): bool
    {
        if ($this->hubs()->where('hub_id', 1)->first()) {
            return true;
        } else {
            return false;
        }
    }
}
