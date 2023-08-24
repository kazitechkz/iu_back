<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use App\Traits\CRUD;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class TournamentLocale
 *
 * @property int $id
 * @property int $tournament_id
 * @property int $locale_id
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Locale $locale
 * @property Tournament $tournament
 *
 * @package App\Models
 */
class TournamentLocale extends Model
{
    use CRUD;
	use SoftDeletes;
	protected $table = 'tournament_locales';

	protected $casts = [
		'tournament_id' => 'int',
		'locale_id' => 'int'
	];

	protected $fillable = [
		'tournament_id',
		'locale_id'
	];

	public function locale()
	{
		return $this->belongsTo(Locale::class);
	}

	public function tournament()
	{
		return $this->belongsTo(Tournament::class);
	}
}
