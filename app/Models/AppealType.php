<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use App\Traits\CRUD;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class AppealType
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
 * @property Collection|Appeal[] $appeals
 *
 * @package App\Models
 */
class AppealType extends Model
{
	use SoftDeletes;
    use CRUD;
	protected $table = 'appeal_types';

	protected $casts = [
		'isActive' => 'bool'
	];

	protected $fillable = [
		'title_ru',
		'title_kk',
		'title_en',
		'isActive'
	];

	public function appeals()
	{
		return $this->hasMany(Appeal::class, 'type_id');
	}
}
