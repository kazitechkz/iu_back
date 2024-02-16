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
 * Class IutubeAuthor
 *
 * @property int $id
 * @property int|null $image_url
 * @property string $name
 * @property string|null $description
 * @property string|null $instagram_url
 * @property string|null $vk_url
 * @property string|null $linkedin_url
 * @property string|null $facebook_url
 * @property string|null $tiktok_url
 * @property string|null $phone
 * @property string|null $email
 * @property bool $is_active
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property File|null $file
 * @property Collection|IutubeVideo[] $iutube_videos
 *
 * @package App\Models
 */
class IutubeAuthor extends Model
{
    use CRUD;
	protected $table = 'iutube_authors';

	protected $casts = [
		'image_url' => 'int',
		'is_active' => 'bool'
	];

	protected $fillable = [
		'image_url',
		'name',
		'description',
		'instagram_url',
		'vk_url',
		'linkedin_url',
		'facebook_url',
		'tiktok_url',
		'phone',
		'email',
		'is_active'
	];

	public function file()
	{
		return $this->belongsTo(File::class, 'image_url');
	}

	public function iutube_videos()
	{
		return $this->hasMany(IutubeVideo::class, 'author_id');
	}
}
