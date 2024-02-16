<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use App\Traits\CRUD;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class IutubeAccess
 *
 * @property int $id
 * @property int $subject_id
 * @property bool $is_active
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Subject $subject
 *
 * @package App\Models
 */
class IutubeAccess extends Model
{
    use CRUD;
	protected $table = 'iutube_access';

	protected $casts = [
		'subject_id' => 'int',
		'is_active' => 'bool'
	];

	protected $fillable = [
		'subject_id',
		'is_active'
	];

	public function subject()
	{
		return $this->belongsTo(Subject::class);
	}
}
