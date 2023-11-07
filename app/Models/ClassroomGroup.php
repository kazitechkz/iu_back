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
 * Class ClassroomGroupController
 *
 * @property int $id
 * @property int $teacher_id
 * @property string $title_kk
 * @property string $title_ru
 * @property string $promo_code
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property User $user
 * @property Collection|Classroom[] $classrooms
 *
 * @package App\Models
 */
class ClassroomGroup extends Model
{
    use CRUD;
	protected $table = 'classroom_groups';

	protected $casts = [
		'teacher_id' => 'int'
	];

	protected $fillable = [
		'teacher_id',
		'title_kk',
		'title_ru',
		'promo_code'
	];

	public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
		return $this->belongsTo(User::class, 'teacher_id');
	}

	public function classrooms(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
		return $this->hasMany(Classroom::class, 'class_id');
	}
}
