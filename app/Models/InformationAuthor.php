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
 * Class InformationAuthor
 *
 * @property int $id
 * @property string $name
 * @property int|null $image_url
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property File|null $file
 * @property Collection|Information[] $information
 *
 * @package App\Models
 */
class InformationAuthor extends Model
{
    use CRUD;
	protected $table = 'information_authors';

	protected $casts = [
		'image_url' => 'int'
	];

	protected $fillable = [
		'name',
		'image_url'
	];

	public function file()
	{
		return $this->belongsTo(File::class, 'image_url');
	}

	public function information()
	{
		return $this->hasMany(Information::class, 'author_id');
	}
}
