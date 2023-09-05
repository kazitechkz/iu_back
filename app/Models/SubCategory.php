<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use App\Traits\CRUD;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class SubCategory
 *
 * @property int $id
 * @property int|null $category_id
 * @property string $title_kk
 * @property string $title_ru
 * @property int|null $image_url
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Category|null $category
 * @property File|null $file
 * @property Collection|Question[] $questions
 *
 * @package App\Models
 */
class SubCategory extends Model
{
    use CRUD;
	protected $table = 'sub_categories';

	protected $casts = [
		'category_id' => 'int',
		'image_url' => 'int'
	];

	protected $fillable = [
		'category_id',
		'title_kk',
		'title_ru',
		'image_url'
	];

	public function category(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
		return $this->belongsTo(Category::class);
	}

	public function file(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
		return $this->belongsTo(File::class, 'image_url');
	}

	public function questions(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
		return $this->hasMany(Question::class);
	}
}
