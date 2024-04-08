<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use App\Traits\CRUD;
use App\Traits\Language;
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
	use SoftDeletes, Language;
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

	public function file(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
		return $this->belongsTo(File::class, 'poster');
	}

	public function subject(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
		return $this->belongsTo(Subject::class);
	}

	public function sub_tournaments(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
		return $this->hasMany(SubTournament::class);
	}

    public function tournament_winner(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(TournamentWinner::class,"tournament_id","id");
    }

	public function locales(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
		return $this->belongsToMany(Locale::class, 'tournament_locales')
                        ->withPivot('id', 'deleted_at')
					->withTimestamps();
	}

    public function participants()
    {
        return $this->sub_tournaments()->where('step_id', 1)->with('subtournament_participants')->first();
    }

    public function firstSubTournament()
    {
        if ($this->sub_tournaments()) {
            $data = $this->sub_tournaments()->where('step_id', 1)->with('tournament_step')->first();
            if ($data) {
                return $data;
            } else {
                return [];
            }
        } else {
            return [];
        }
    }

    public function currentSubTournament()
    {
        if ($this->sub_tournaments()) {
            $data = $this->sub_tournaments()->where('is_current', 1)->with([
                'tournament_step',
                'subtournament_participants',
                'sub_tournament_results' => function ($q) {
                    return $q->where('user_id', auth()->guard('api')->id())->with(['user', 'attempt']);
                }
            ])->first();
            if ($data) {
                return $data;
            } else {
                return [];
            }
        } else {
            return [];
        }
    }


    public function winnerTournament()
    {
        $tournament_winner =  $this->tournament_winner()->with("winner")->first();
        return $tournament_winner ? $tournament_winner->winner : null;
    }

    public function check_access(): bool
    {
        $currentST = false;
        if ($this->currentSubTournament()) {
            $currentST = (bool)$this->currentSubTournament()->subtournament_participants()->where('user_id', auth()->guard('api')->id())->first();
        }
        return $currentST;
    }
}
