<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use App\Traits\CRUD;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class SubjectContextTranslation
 *
 * @property int $id
 * @property int $context_kk
 * @property int $context_ru
 * @property int $subject_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property SubjectContext $subject_context
 * @property Subject $subject
 *
 * @package App\Models
 */
class SubjectContextTranslation extends Model
{
    use CRUD;
	protected $table = 'subject_context_translations';

	protected $casts = [
		'context_kk' => 'int',
		'context_ru' => 'int',
		'subject_id' => 'int'
	];

	protected $fillable = [
		'context_kk',
		'context_ru',
		'subject_id'
	];

	public function subject_context_ru(): BelongsTo
    {
		return $this->belongsTo(SubjectContext::class, 'context_ru');
	}

	public function subject_context_kk(): BelongsTo
    {
		return $this->belongsTo(SubjectContext::class, 'context_kk');
	}

	public function subject(): BelongsTo
    {
		return $this->belongsTo(Subject::class);
	}
}
