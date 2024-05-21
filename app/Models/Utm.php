<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Utm
 * 
 * @property int $id
 * @property int $page_id
 * @property int $count
 * @property Carbon $visit_date
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property UrlPage $url_page
 *
 * @package App\Models
 */
class Utm extends Model
{
	protected $table = 'utms';

	protected $casts = [
		'page_id' => 'int',
		'count' => 'int',
		'visit_date' => 'datetime'
	];

	protected $fillable = [
		'page_id',
		'count',
		'visit_date'
	];

	public function url_page()
	{
		return $this->belongsTo(UrlPage::class, 'page_id');
	}
}
