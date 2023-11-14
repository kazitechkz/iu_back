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
 * Class Category
 *
 * @property int $id
 * @property int|null $subject_id
 * @property string $title_kk
 * @property string $title_ru
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 *
 * @property Subject|null $subject
 *
 * @package App\Models
 */
class Category extends Model
{
	use SoftDeletes, CRUD, Language;
	protected $table = 'categories';

	protected $casts = [
		'subject_id' => 'int'
	];

	protected $fillable = [
		'subject_id',
		'title_kk',
		'title_ru'
	];

	public function subject(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
		return $this->belongsTo(Subject::class);
	}

    public function subcategories(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(SubCategory::class, 'category_id', 'id');
    }

    public function questions(): \Illuminate\Database\Eloquent\Relations\HasManyThrough
    {
        return $this->hasManyThrough(Question::class, SubCategory::class);
    }

    public function s_questions(): \Illuminate\Database\Eloquent\Relations\HasManyThrough
    {
        return $this->questions()->where('type_id', 1);
    }

    public function c_questions(): \Illuminate\Database\Eloquent\Relations\HasManyThrough
    {
        return $this->questions()->where('type_id', 2);
    }

    public function m_questions(): \Illuminate\Database\Eloquent\Relations\HasManyThrough
    {
        return $this->questions()->where('type_id', 3);
    }
}
