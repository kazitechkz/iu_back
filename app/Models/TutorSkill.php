<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use App\Traits\CRUD;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TutorSkill
 *
 * @property int $id
 * @property int $tutor_id
 * @property int $subject_id
 * @property int $category_id
 * @property int $sub_category_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Category $category
 * @property SubCategory $sub_category
 * @property Subject $subject
 * @property Tutor $tutor
 *
 * @package App\Models
 */
class TutorSkill extends Model
{
    use CRUD;
	protected $table = 'tutor_skills';

	protected $casts = [
		'tutor_id' => 'int',
		'subject_id' => 'int',
		'category_id' => 'int',
	];

	protected $fillable = [
		'tutor_id',
		'subject_id',
		'category_id',
	];

	public function category()
	{
		return $this->belongsTo(Category::class);
	}


	public function subject()
	{
		return $this->belongsTo(Subject::class);
	}

	public function tutor()
	{
		return $this->belongsTo(Tutor::class);
	}
}
