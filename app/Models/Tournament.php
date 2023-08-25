<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use App\Traits\CRUD;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Tournament
 *
 * @property int $id
 * @property int $subject_id
 * @property string $title_ru
 * @property string $title_kk
 * @property string|null $title_en
 * @property string $rule_ru
 * @property string $rule_kk
 * @property string|null $rule_en
 * @property string $description_ru
 * @property string $description_kk
 * @property string|null $description_en
 * @property int $price
 * @property string $currency
 * @property int|null $poster
 * @property int $status
 * @property Carbon $start_at
 * @property Carbon $end_at
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property File|null $file
 * @property Subject $subject
 * @property Collection|SubTournament[] $sub_tournaments
 * @property Collection|Locale[] $locales
 *
 * @package App\Models
 */
class Tournament extends Model
{
    use CRUD;
	use SoftDeletes;
	protected $table = 'tournaments';

	protected $casts = [
		'subject_id' => 'int',
		'price' => 'int',
		'poster' => 'int',
		'status' => 'int',
		'start_at' => 'datetime',
		'end_at' => 'datetime'
	];

	protected $fillable = [
		'subject_id',
		'title_ru',
		'title_kk',
		'title_en',
		'rule_ru',
		'rule_kk',
		'rule_en',
		'description_ru',
		'description_kk',
		'description_en',
		'price',
		'currency',
		'poster',
		'status',
		'start_at',
		'end_at'
	];

	public function file()
	{
		return $this->belongsTo(File::class, 'poster');
	}

	public function subject()
	{
		return $this->belongsTo(Subject::class);
	}

	public function sub_tournaments()
	{
		return $this->hasMany(SubTournament::class);
	}

	public function locales()
	{
		return $this->belongsToMany(Locale::class, 'tournament_locales')
                        ->withPivot('id', 'deleted_at')
					->withTimestamps();
	}
}
