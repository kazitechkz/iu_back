<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use App\Helpers\StrHelper;
use App\Traits\CRUD;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class SubjectContext
 *
 * @property int $id
 * @property int $subject_id
 * @property string $context
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 *
 * @property Subject $subject
 * @property Collection|Question[] $questions
 *
 * @package App\Models
 */
class SubjectContext extends Model
{
	use SoftDeletes, CRUD;
	protected $table = 'subject_contexts';

	protected $casts = [
		'subject_id' => 'int'
	];

	protected $fillable = [
		'subject_id',
		'context'
	];

	public function subject(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
		return $this->belongsTo(Subject::class);
	}

	public function questions(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
		return $this->hasMany(Question::class, 'context_id');
	}

    public function getTitleAttribute(): string
    {
        return StrHelper::getSubStr($this['context'], 20);
    }
}
