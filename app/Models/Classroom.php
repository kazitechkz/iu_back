<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use App\Traits\CRUD;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Classroom
 *
 * @property int $id
 * @property int $class_id
 * @property int $student_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property ClassroomGroup $classroom_group
 * @property User $user
 *
 * @package App\Models
 */
class Classroom extends Model
{
    use CRUD;
	protected $table = 'classrooms';

	protected $casts = [
		'class_id' => 'int',
		'student_id' => 'int',
        'subjects' => 'json'
	];

	protected $fillable = [
		'class_id',
		'student_id',
        'subjects'
	];

	public function classroom_group(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
		return $this->belongsTo(ClassroomGroup::class, 'class_id');
	}

	public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
		return $this->belongsTo(User::class, 'student_id');
	}
}
