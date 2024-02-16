<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use App\Traits\CRUD;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class IutubeVideo
 *
 * @property int $id
 * @property string $alias
 * @property string $title
 * @property string|null $description
 * @property int|null $image_url
 * @property int $author_id
 * @property int $locale_id
 * @property int $subject_id
 * @property int|null $step_id
 * @property int|null $sub_step_id
 * @property string $video_url
 * @property int $price
 * @property bool $is_public
 * @property bool $is_recommended
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property IutubeAuthor $iutube_author
 * @property File|null $file
 * @property Locale $locale
 * @property Step|null $step
 * @property SubStep|null $sub_step
 * @property Subject $subject
 *
 * @package App\Models
 */
class IutubeVideo extends Model
{
    use CRUD;
	protected $table = 'iutube_videos';

	protected $casts = [
		'image_url' => 'int',
		'author_id' => 'int',
		'locale_id' => 'int',
		'subject_id' => 'int',
		'step_id' => 'int',
		'sub_step_id' => 'int',
		'price' => 'int',
		'is_public' => 'bool',
		'is_recommended' => 'bool'
	];

	protected $fillable = [
		'alias',
		'title',
		'description',
		'image_url',
		'author_id',
		'locale_id',
		'subject_id',
		'step_id',
		'sub_step_id',
		'video_url',
		'price',
		'is_public',
		'is_recommended'
	];

	public function iutube_author()
	{
		return $this->belongsTo(IutubeAuthor::class, 'author_id');
	}

	public function file()
	{
		return $this->belongsTo(File::class, 'image_url');
	}

	public function locale()
	{
		return $this->belongsTo(Locale::class);
	}

	public function step()
	{
		return $this->belongsTo(Step::class);
	}

	public function sub_step()
	{
		return $this->belongsTo(SubStep::class);
	}

	public function subject()
	{
		return $this->belongsTo(Subject::class);
	}
}
