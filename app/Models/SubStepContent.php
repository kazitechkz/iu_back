<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use App\Traits\CRUD;
use App\Traits\Language;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class SubStepContent
 *
 * @property int $id
 * @property string $text_ru
 * @property string $text_kk
 * @property string|null $text_en
 * @property int $sub_step_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property SubStep $sub_step
 *
 * @package App\Models
 */
class SubStepContent extends Model
{
    use CRUD, Language;
	protected $table = 'sub_step_contents';

	protected $casts = [
		'sub_step_id' => 'int'
	];

	protected $fillable = [
		'text_ru',
		'text_kk',
		'text_en',
		'sub_step_id',
        'is_active'
	];

	public function sub_step(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
		return $this->belongsTo(SubStep::class);
	}
}
