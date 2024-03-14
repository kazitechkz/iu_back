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
 * Class TournamentPrize
 *
 * @property int $id
 * @property string $title_ru
 * @property string $title_kk
 * @property string|null $title_en
 * @property bool $is_virtual
 * @property int $tournament_id
 * @property int|null $order
 * @property int|null $start_from
 * @property int|null $end_to
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int|null $value
 *
 * @property Tournament $tournament
 *
 * @package App\Models
 */
class TournamentPrize extends Model
{
	use SoftDeletes,CRUD;
	protected $table = 'tournament_prizes';

	protected $casts = [
		'is_virtual' => 'bool',
		'tournament_id' => 'int',
		'order' => 'int',
		'start_from' => 'int',
		'end_to' => 'int',
		'value' => 'int'
	];

	protected $fillable = [
		'title_ru',
		'title_kk',
		'title_en',
		'is_virtual',
		'tournament_id',
		'order',
		'start_from',
		'end_to',
		'value'
	];

	public function tournament()
	{
		return $this->belongsTo(Tournament::class);
	}
}
