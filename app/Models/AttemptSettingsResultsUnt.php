<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use App\Traits\CRUD;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class AttemptSettingsResultsUnt
 *
 * @property int $id
 * @property int $setting_id
 * @property int $attempt_id
 * @property int $user_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Attempt $attempt
 * @property AttemptSettingsUnt $attempt_settings_unt
 * @property User $user
 *
 * @package App\Models
 */
class AttemptSettingsResultsUnt extends Model
{
    use CRUD;
	protected $table = 'attempt_settings_results_unt';

	protected $casts = [
		'setting_id' => 'int',
		'attempt_id' => 'int',
		'user_id' => 'int'
	];

	protected $fillable = [
		'setting_id',
		'attempt_id',
		'user_id'
	];

	public function attempt()
	{
		return $this->belongsTo(Attempt::class);
	}

	public function attempt_settings_unt()
	{
		return $this->belongsTo(AttemptSettingsUnt::class, 'setting_id');
	}

	public function user()
	{
		return $this->belongsTo(User::class)->select([
            'id',
            "username",
            'name',
            'phone',
            'email',
            'image_url'
        ])->with("file");
	}
}
