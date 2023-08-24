<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class SubjectRelation
 * 
 * @property int $id
 * @property int $subject_id
 * @property int $relation_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * 
 * @property Subject $subject
 *
 * @package App\Models
 */
class SubjectRelation extends Model
{
	use SoftDeletes;
	protected $table = 'subject_relations';

	protected $casts = [
		'subject_id' => 'int',
		'relation_id' => 'int'
	];

	protected $fillable = [
		'subject_id',
		'relation_id'
	];

	public function subject()
	{
		return $this->belongsTo(Subject::class);
	}
}
