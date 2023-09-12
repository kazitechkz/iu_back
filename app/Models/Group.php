<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use App\Traits\CRUD;
use App\Traits\Language;
use Bpuig\Subby\Models\Plan;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Group
 *
 * @property int $id
 * @property string $title_ru
 * @property string $title_kk
 * @property string $title_en
 * @property bool $isActive
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Collection|Plan[] $plans
 *
 * @package App\Models
 */
class Group extends Model
{
	use SoftDeletes, Language;
    use CRUD;
	protected $table = 'groups';

	protected $casts = [
		'isActive' => 'bool'
	];

	protected $fillable = [
		'title_ru',
		'title_kk',
		'title_en',
		'isActive'
	];

	public function plans()
	{
		return $this->belongsToMany(Plan::class)
					->withPivot('id');
	}
}
