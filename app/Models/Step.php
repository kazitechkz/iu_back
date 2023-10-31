<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use App\Traits\CRUD;
use App\Traits\Language;
use Bpuig\Subby\Models\Plan;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Step
 *
 * @property int $id
 * @property string $title_ru
 * @property string $title_kk
 * @property string|null $title_en
 * @property int $subject_id
 * @property int $category_id
 * @property int $plan_id
 * @property int $level
 * @property bool $is_free
 * @property bool $is_active
 * @property int|null $image_url
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Category $category
 * @property File|null $image
 * @property Plan $plan
 * @property Subject $subject
 * @property Collection|SubStep[] $sub_steps
 * @property StepResult $result
 *
 * @package App\Models
 */
class Step extends Model
{
	use SoftDeletes,CRUD, Language;
	protected $table = 'steps';

	protected $casts = [
		'subject_id' => 'int',
		'category_id' => 'int',
		'plan_id' => 'int',
		'level' => 'int',
		'is_free' => 'bool',
		'is_active' => 'bool',
		'image_url' => 'int'
	];

	protected $fillable = [
		'title_ru',
		'title_kk',
		'title_en',
		'subject_id',
		'category_id',
		'plan_id',
		'level',
		'is_free',
		'is_active',
		'image_url'
	];

	public function category(): BelongsTo
    {
		return $this->belongsTo(Category::class);
	}

	public function file(): BelongsTo
    {
		return $this->belongsTo(File::class, 'image_url');
	}

	public function plan(): BelongsTo
    {
		return $this->belongsTo(Plan::class);
	}

	public function subject(): BelongsTo
    {
		return $this->belongsTo(Subject::class);
	}

	public function sub_steps(): HasMany
    {
		return $this->hasMany(SubStep::class);
	}

    public function image(): BelongsTo
    {
        return $this->belongsTo(File::class, 'image_url', 'id');
    }

    public function results(): HasMany
    {
        return $this->hasMany(StepResult::class, 'step_id','id');
    }

    public function own_result(): HasMany
    {
        return $this->results()->where('user_id', auth()->guard('api')->id());
    }
}
