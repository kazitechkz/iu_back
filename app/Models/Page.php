<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use App\Traits\CRUD;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Page
 *
 * @property int $id
 * @property string $title
 * @property string $content
 * @property bool $isActive
 * @property int $locale_id
 * @property string $code
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Locale $locale
 *
 * @package App\Models
 */
class Page extends Model
{
    use CRUD;
	protected $table = 'pages';

	protected $casts = [
		'isActive' => 'bool',
		'locale_id' => 'int'
	];

	protected $fillable = [
		'title',
		'content',
		'isActive',
		'locale_id',
		'code'
	];

	public function locale()
	{
		return $this->belongsTo(Locale::class);
	}
}
