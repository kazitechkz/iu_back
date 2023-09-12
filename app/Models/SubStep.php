<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use App\Helpers\MathFormulaHelper;
use App\Traits\CRUD;
use App\Traits\Language;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class SubStep
 *
 * @property int $id
 * @property string $title_ru
 * @property string $title_kk
 * @property string|null $title_en
 * @property int $step_id
 * @property int $sub_category_id
 * @property int $level
 * @property bool $is_active
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Step $step
 * @property SubCategory $sub_category
 * @property Collection|SubStepContent[] $sub_step_contents
 *
 * @package App\Models
 */
class SubStep extends Model
{
	use SoftDeletes, CRUD, Language;
	protected $table = 'sub_steps';

	protected $casts = [
		'step_id' => 'int',
		'sub_category_id' => 'int',
		'level' => 'int',
		'is_active' => 'bool'
	];

	protected $fillable = [
		'title_ru',
		'title_kk',
		'title_en',
		'step_id',
		'sub_category_id',
		'level',
		'is_active'
	];

	public function step(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
		return $this->belongsTo(Step::class);
	}

	public function sub_category(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
		return $this->belongsTo(SubCategory::class);
	}

	public function sub_step_contents(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
		return $this->hasMany(SubStepContent::class);
	}

    public function sub_result(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(SubStepResult::class, 'id', 'sub_step_id');
    }
}
