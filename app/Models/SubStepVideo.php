<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use App\Traits\CRUD;
use App\Traits\Language;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class SubStepVideo
 *
 * @property int $id
 * @property int $sub_step_id
 * @property string $url
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property SubStep $sub_step
 *
 * @package App\Models
 */
class SubStepVideo extends Model
{
    use CRUD;
	protected $table = 'sub_step_video';

	protected $casts = [
		'sub_step_id' => 'int'
	];

	protected $fillable = [
		'sub_step_id',
		'url'
	];

	public function sub_step(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
		return $this->belongsTo(SubStep::class, 'sub_step_id', 'id');
	}
}
