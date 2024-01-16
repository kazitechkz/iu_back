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
 * Class CareerQuizAuthor
 *
 * @property int $id
 * @property int $group_id
 * @property int|null $image_url
 * @property string $name
 * @property string $position_ru
 * @property string $position_kk
 * @property string $description_ru
 * @property string $description_kk
 * @property string|null $instagram_url
 * @property string|null $facebook_url
 * @property string|null $vk_url
 * @property string|null $linkedin_url
 * @property string|null $site
 * @property string|null $email
 * @property string|null $phone
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property CareerQuizGroup $career_quiz_group
 * @property File|null $file
 * @property Collection|CareerQuizCreator[] $career_quiz_creators
 *
 * @package App\Models
 */
class CareerQuizAuthor extends Model
{
    use CRUD;

    protected $table = 'career_quiz_authors';

	protected $casts = [
		'group_id' => 'int',
		'image_url' => 'int'
	];

	protected $fillable = [
		'group_id',
		'image_url',
		'name',
		'position_ru',
		'position_kk',
		'description_ru',
		'description_kk',
		'instagram_url',
		'facebook_url',
		'vk_url',
		'linkedin_url',
		'site',
		'email',
		'phone'
	];

	public function career_quiz_group()
	{
		return $this->belongsTo(CareerQuizGroup::class, 'group_id');
	}

	public function file()
	{
		return $this->belongsTo(File::class, 'image_url');
	}

	public function career_quiz_creators()
	{
		return $this->hasMany(CareerQuizCreator::class, 'author_id');
	}
}
