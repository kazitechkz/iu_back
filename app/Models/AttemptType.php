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
 * Class AttemptType
 *
 * @property int $id
 * @property string $title_ru
 * @property string $title_kk
 * @property string|null $title_en
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Collection|Attempt[] $attempts
 *
 * @package App\Models
 */
class AttemptType extends Model
{
    use CRUD, Language;
	use SoftDeletes;
	protected $table = 'attempt_types';

	protected $fillable = [
		'title_ru',
		'title_kk',
		'title_en'
	];

	public function attempts()
	{
		return $this->hasMany(Attempt::class, 'type_id');
	}
}
