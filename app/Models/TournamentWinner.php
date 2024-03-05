<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use App\Traits\CRUD;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TournamentWinner
 *
 * @property int $id
 * @property int $winner_id
 * @property int $tournament_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Tournament $tournament
 * @property User $user
 *
 * @package App\Models
 */
class TournamentWinner extends Model
{
    use CRUD;
	protected $table = 'tournament_winner';

	protected $casts = [
		'winner_id' => 'int',
		'tournament_id' => 'int'
	];

	protected $fillable = [
		'winner_id',
		'tournament_id'
	];

	public function tournament()
	{
		return $this->belongsTo(Tournament::class);
	}

	public function winner()
	{
		return $this->belongsTo(User::class, 'winner_id')->select([
            'id',
            "username",
            'name',
            'phone',
            'email',
            'image_url'
        ])->with("file");
	}
}
