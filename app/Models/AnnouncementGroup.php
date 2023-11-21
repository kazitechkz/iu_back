<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use App\Traits\CRUD;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class AnnouncementGroup
 *
 * @property int $id
 * @property string $title_ru
 * @property string $title_kk
 * @property string|null $title_en
 * @property bool $is_active
 * @property int|null $thumbnail
 * @property Carbon $start_date
 * @property Carbon $end_date
 * @property int $order
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property File|null $file
 *
 * @package App\Models
 */
class AnnouncementGroup extends Model
{
    use CRUD;
	protected $table = 'announcement_groups';

	protected $casts = [
		'is_active' => 'bool',
		'thumbnail' => 'int',
		'start_date' => 'datetime',
		'end_date' => 'datetime',
		'order' => 'int'
	];

	protected $fillable = [
		'title_ru',
		'title_kk',
		'title_en',
		'is_active',
		'thumbnail',
		'start_date',
		'end_date',
		'order'
	];

	public function file()
	{
		return $this->belongsTo(File::class, 'thumbnail');
	}

    public function announcements(){
        return $this->hasMany(Announcement::class,"group_id","id")->with(["image","announcement_type"]);
    }
}
