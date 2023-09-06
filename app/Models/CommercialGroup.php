<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use App\Traits\CRUD;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CommercialGroup
 *
 * @property int $id
 * @property string $title_ru
 * @property string $title_kk
 * @property string|null $title_en
 * @property string $tag
 * @property bool $is_active
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Collection|Plan[] $plans
 *
 * @package App\Models
 */
class CommercialGroup extends Model
{
    use CRUD;
	protected $table = 'commercial_groups';

	protected $casts = [
		'is_active' => 'bool'
	];

	protected $fillable = [
		'title_ru',
		'title_kk',
		'title_en',
		'tag',
		'is_active'
	];

	public function plans()
	{
		return $this->belongsToMany(Plan::class, 'commercial_group_plan', 'group_id')
					->withPivot('id')
					->withTimestamps();
	}
}
