<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Hub
 *
 * @property int $id
 * @property string $title_kk
 * @property string $title_ru
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Collection|User[] $users
 *
 * @package App\Models
 */
class Hub extends Model
{
	protected $table = 'hubs';

	protected $fillable = [
		'title_kk',
		'title_ru'
	];

	public function users()
	{
		return $this->belongsToMany(User::class, 'user_hubs')
					->withPivot('id')
					->withTimestamps();
	}
}
