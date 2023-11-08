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
 * Class SubTournamentWinner
 *
 * @property int $id
 * @property int $user_id
 * @property int $sub_tournament_id
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property SubTournament $sub_tournament
 * @property User $user
 *
 * @package App\Models
 */
class SubTournamentWinner extends Model
{
    use CRUD;
	use SoftDeletes;
	protected $table = 'sub_tournament_winners';

	protected $casts = [
		'user_id' => 'int',
		'sub_tournament_id' => 'int'
	];

	protected $fillable = [
		'user_id',
		'sub_tournament_id'
	];

	public function sub_tournament()
	{
		return $this->belongsTo(SubTournament::class);
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
