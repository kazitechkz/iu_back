<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use App\Traits\CRUD;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class News
 *
 * @property int $id
 * @property string $title
 * @property string $subtitle
 * @property int|null $image_url
 * @property int|null $poster
 * @property int|null $locale_id
 * @property string $description
 * @property bool $is_active
 * @property bool $is_important
 * @property Carbon $published_at
 * @property int|null $published_by
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property File|null $file
 * @property Locale|null $locale
 * @property User|null $user
 *
 * @package App\Models
 */
class News extends Model
{
	use SoftDeletes,CRUD;
	protected $table = 'news';

	protected $casts = [
		'image_url' => 'int',
		'poster' => 'int',
		'locale_id' => 'int',
		'is_active' => 'bool',
		'is_important' => 'bool',
		'published_at' => 'datetime',
		'published_by' => 'int'
	];

	protected $fillable = [
		'title',
		'subtitle',
		'image_url',
		'poster',
		'locale_id',
		'description',
		'is_active',
		'is_important',
		'published_at',
		'published_by'
	];

	public function poster()
	{
		return $this->belongsTo(File::class, 'poster');
	}
    public function image():BelongsTo
    {
        return $this->belongsTo(File::class, 'image_url');
    }

	public function locale()
	{
		return $this->belongsTo(Locale::class);
	}

	public function user()
	{
		return $this->belongsTo(User::class, 'published_by');
	}
}
