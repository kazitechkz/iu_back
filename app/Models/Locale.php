<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use App\Traits\CRUD;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Locale
 *
 * @property int $id
 * @property string $title
 * @property string $code
 * @property bool $isActive
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class Locale extends Model
{
	use SoftDeletes;
    use CRUD;
	protected $table = 'locales';

	protected $casts = [
		'isActive' => 'bool'
	];

	protected $fillable = [
		'title',
		'code',
		'isActive'
	];
}
