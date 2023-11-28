<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use App\Traits\CRUD;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Fact
 *
 * @property int $id
 * @property int $subject_id
 * @property string $text_kk
 * @property string $text_ru
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Subject $subject
 *
 * @package App\Models
 */
class Fact extends Model
{
    use CRUD;
	protected $table = 'facts';

	protected $casts = [
		'subject_id' => 'int'
	];

	protected $fillable = [
		'subject_id',
		'text_kk',
		'text_ru'
	];

	public function subject(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
		return $this->belongsTo(Subject::class);
	}
}
