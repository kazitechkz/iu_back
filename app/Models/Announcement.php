<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use App\Traits\CRUD;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Announcement
 *
 * @property int $id
 * @property int $type_id
 * @property int $group_id
 * @property int|null $background
 * @property string $title
 * @property string $sub_title
 * @property string|null $description
 * @property int $time_in_sec
 * @property string|null $url_text
 * @property string|null $url
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property File|null $file
 * @property Group $group
 * @property AnnouncementType $announcement_type
 *
 * @package App\Models
 */
class Announcement extends Model
{
    use CRUD;
	protected $table = 'announcements';

	protected $casts = [
		'type_id' => 'int',
		'group_id' => 'int',
		'background' => 'int',
		'time_in_sec' => 'int'
	];

	protected $fillable = [
		'type_id',
		'group_id',
		'background',
		'title',
		'sub_title',
		'description',
		'time_in_sec',
		'url_text',
		'url'
	];

	public function file()
	{
		return $this->belongsTo(File::class, 'background');
	}

	public function group()
	{
		return $this->belongsTo(Group::class);
	}

	public function announcement_type()
	{
		return $this->belongsTo(AnnouncementType::class, 'type_id');
	}
}
