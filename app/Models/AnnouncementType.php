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
 * Class AnnouncementType
 *
 * @property int $id
 * @property string $title_ru
 * @property string $title_kk
 * @property string|null $title_en
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Collection|Announcement[] $announcements
 *
 * @package App\Models
 */
class AnnouncementType extends Model
{
    use CRUD;
	protected $table = 'announcement_types';

	protected $fillable = [
		'title_ru',
		'title_kk',
		'title_en'
	];

	public function announcements()
	{
		return $this->hasMany(Announcement::class, 'type_id');
	}
}
