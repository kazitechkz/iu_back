<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use App\Traits\Language;
use App\Traits\CRUD;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Gender
 *
 * @property int $id
 * @property string $title_ru
 * @property string $title_kk
 * @property string $title_en
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Collection|Tutor[] $tutors
 *
 * @package App\Models
 */
class Gender extends Model
{
    use Language;
    use CRUD;
	protected $table = 'genders';

	protected $fillable = [
		'title_ru',
		'title_kk',
		'title_en'
	];

	public function tutors()
	{
		return $this->hasMany(Tutor::class);
	}
}
