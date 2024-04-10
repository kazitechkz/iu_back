<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use App\Traits\CRUD;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Information
 *
 * @property int $id
 * @property string $alias
 * @property int $author_id
 * @property int $category_id
 * @property int|null $image_url
 * @property string $seo_title
 * @property string $seo_description
 * @property string $seo_keywords
 * @property string $title_ru
 * @property string $title_kk
 * @property string $description_ru
 * @property string $description_kk
 * @property bool $is_active
 * @property bool $is_main
 * @property Carbon $published_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property InformationAuthor $information_author
 * @property InformationCategory $information_category
 * @property File|null $file
 *
 * @package App\Models
 */
class Information extends Model
{
    use CRUD;
	protected $table = 'informations';

	protected $casts = [
		'author_id' => 'int',
		'category_id' => 'int',
		'image_url' => 'int',
		'is_active' => 'bool',
		'is_main' => 'bool',
		'published_at' => 'datetime'
	];

	protected $fillable = [
		'alias',
		'author_id',
		'category_id',
		'image_url',
		'seo_title',
		'seo_description',
		'seo_keywords',
		'title_ru',
		'title_kk',
		'description_ru',
		'description_kk',
		'is_active',
		'is_main',
		'published_at'
	];

	public function information_author()
	{
		return $this->belongsTo(InformationAuthor::class, 'author_id');
	}

	public function information_category()
	{
		return $this->belongsTo(InformationCategory::class, 'category_id');
	}

	public function file()
	{
		return $this->belongsTo(File::class, 'image_url');
	}
}
