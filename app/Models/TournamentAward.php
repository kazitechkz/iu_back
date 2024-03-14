<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class TournamentAward
 *
 * @property int $id
 * @property string $title_ru
 * @property string $title_kk
 * @property string|null $title_en
 * @property bool $is_awarded
 * @property int $tournament_id
 * @property int $sub_tournament_id
 * @property int $user_id
 * @property int $order
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property SubTournament $sub_tournament
 * @property Tournament $tournament
 * @property User $user
 *
 * @package App\Models
 */
class TournamentAward extends Model
{
	use SoftDeletes;
	protected $table = 'tournament_awards';

	protected $casts = [
		'is_awarded' => 'bool',
		'tournament_id' => 'int',
		'sub_tournament_id' => 'int',
		'user_id' => 'int',
		'order' => 'int'
	];

	protected $fillable = [
		'title_ru',
		'title_kk',
		'title_en',
		'is_awarded',
		'tournament_id',
		'sub_tournament_id',
		'user_id',
		'order'
	];

	public function sub_tournament()
	{
		return $this->belongsTo(SubTournament::class);
	}

	public function tournament()
	{
		return $this->belongsTo(Tournament::class);
	}

	public function user()
	{
        return $this->belongsTo(User::class,"user_id","id")->select([
            'id',
            "username",
            'name',
            'phone',
            'email',
            'image_url'
        ])->with("file");
	}
}
