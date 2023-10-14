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
 * Class SubTournamentParticipant
 *
 * @property int $id
 * @property int $user_id
 * @property int $sub_tournament_id
 * @property int $status
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property SubTournament $sub_tournament
 * @property User $user
 *
 * @package App\Models
 */
class SubTournamentParticipant extends Model
{
    use CRUD;
	use SoftDeletes;
	protected $table = 'sub_tournament_participants';

	protected $casts = [
		'user_id' => 'int',
		'sub_tournament_id' => 'int',
		'status' => 'int'
	];

	protected $fillable = [
		'user_id',
		'sub_tournament_id',
		'status'
	];

	public function sub_tournament()
	{
		return $this->belongsTo(SubTournament::class);
	}

	public function user()
	{
		return $this->belongsTo(User::class,"user_id","id")->select([
            'id',
            "username",
            'name',
            'phone',
            'email',]);
	}
}
