<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class UrlPage
 * 
 * @property int $id
 * @property string $title
 * @property string $url
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Utm[] $utms
 *
 * @package App\Models
 */
class UrlPage extends Model
{
	protected $table = 'url_pages';

	protected $fillable = [
		'title',
		'url'
	];

	public function utms()
	{
		return $this->hasMany(Utm::class, 'page_id');
	}
}
