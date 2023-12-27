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
 * Class Battle
 *
 * @property int $id
 * @property string $promo_code
 * @property int $price
 * @property string|null $pass_code
 * @property int $owner_id
 * @property int|null $guest_id
 * @property int|null $winner_id
 * @property int $locale_id
 * @property int $owner_point
 * @property int $guest_point
 * @property bool $is_open
 * @property bool $is_finished
 * @property Carbon $start_at
 * @property Carbon|null $end_at
 * @property Carbon $must_finished_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property User|null $user
 * @property Locale $locale
 * @property Collection|BattleStep[] $battle_steps
 *
 * @package App\Models
 */
class Battle extends Model
{
    use CRUD;
	protected $table = 'battles';

	protected $casts = [
		'price' => 'int',
		'owner_id' => 'int',
		'guest_id' => 'int',
		'winner_id' => 'int',
		'locale_id' => 'int',
		'owner_point' => 'int',
		'guest_point' => 'int',
		'is_open' => 'bool',
		'is_finished' => 'bool',
		'start_at' => 'datetime',
		'end_at' => 'datetime',
		'must_finished_at' => 'datetime'
	];

	protected $fillable = [
		'promo_code',
		'price',
		'pass_code',
		'owner_id',
		'guest_id',
		'winner_id',
		'locale_id',
		'owner_point',
		'guest_point',
		'is_open',
		'is_finished',
		'start_at',
		'end_at',
		'must_finished_at'
	];

	public function owner()
	{
        return $this->belongsTo(User::class, 'owner_id',"id")->select([
            'id',
            "username",
            'name',
            'phone',
            'email',
            'image_url'
        ])->with("file");
	}
    public function guest()
    {
        return $this->belongsTo(User::class, 'guest_id',"id")->select([
            'id',
            "username",
            'name',
            'phone',
            'email',
            'image_url'
        ])->with("file");
    }

    public function winner()
    {
        return $this->belongsTo(User::class, 'winner_id',"id")->select([
            'id',
            "username",
            'name',
            'phone',
            'email',
            'image_url'
        ])->with("file");
    }

	public function locale()
	{
		return $this->belongsTo(Locale::class);
	}

	public function battle_steps()
	{
		return $this->hasMany(BattleStep::class);
	}
    protected $appends = array('time_left_seconds');
    public function getTimeLeftSecondsAttribute()
    {
        return Carbon::now()->diffInSeconds($this->must_finished_at);
    }

    public function battleQuestions(){
        return $this->hasManyThrough(BattleStepQuestion::class, BattleStep::class, 'battle_id', 'step_id', 'id');
    }
    public function battleResults(){
        return $this->hasManyThrough(BattleStepResult::class, BattleStep::class, 'battle_id', 'step_id', 'id');
    }
}
