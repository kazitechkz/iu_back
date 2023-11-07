<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use App\Traits\CRUD;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ForumFile
 *
 * @property int $id
 * @property int|null $forum_id
 * @property int $file_url
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property File $file
 * @property Forum|null $forum
 *
 * @package App\Models
 */
class ForumFile extends Model
{
	protected $table = 'forum_files';
    use CRUD;
	protected $casts = [
		'forum_id' => 'int',
		'file_url' => 'int'
	];

	protected $fillable = [
		'forum_id',
		'file_url'
	];

	public function file()
	{
		return $this->belongsTo(File::class, 'file_url');
	}

	public function forum()
	{
		return $this->belongsTo(Forum::class);
	}
}
