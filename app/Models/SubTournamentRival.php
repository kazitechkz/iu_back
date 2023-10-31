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
 * Class SubTournamentRival
 *
 * @property int $id
 * @property int $rival_one
 * @property int $point_one
 * @property int $time_one
 * @property int $rival_two
 * @property int $point_two
 * @property int $time_two
 * @property int $winner
 * @property int $sub_tournament_id
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property User $user
 * @property SubTournament $sub_tournament
 *
 * @package App\Models
 */
class SubTournamentRival extends Model
{
    use CRUD;
	use SoftDeletes;
	protected $table = 'sub_tournament_rivals';

	protected $casts = [
		'rival_one' => 'int',
		'point_one' => 'int',
		'time_one' => 'int',
		'rival_two' => 'int',
		'point_two' => 'int',
		'time_two' => 'int',
		'winner' => 'int',
		'sub_tournament_id' => 'int'
	];

	protected $fillable = [
		'rival_one',
		'point_one',
		'time_one',
		'rival_two',
		'point_two',
		'time_two',
		'winner',
		'sub_tournament_id'
	];

	public function winner_user()
	{
		return $this->belongsTo(User::class, 'winner',"id")->select([
            'id',
            "username",
            'name',
            'phone',
            'email',]);
	}
    public function rival_one_user()
    {
        return $this->belongsTo(User::class, 'rival_one',"id")->select([
            'id',
            "username",
            'name',
            'phone',
            'email',]);
    }
    public function rival_two_user()
    {
        return $this->belongsTo(User::class, 'rival_two',"id")->select([
            'id',
            "username",
            'name',
            'phone',
            'email',]);
    }
	public function sub_tournament()
	{
		return $this->belongsTo(SubTournament::class);
	}
}
