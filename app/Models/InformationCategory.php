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
 * Class InformationCategory
 *
 * @property int $id
 * @property string $alias
 * @property string $title_ru
 * @property string $title_kk
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Collection|Information[] $information
 *
 * @package App\Models
 */
class InformationCategory extends Model
{
    use CRUD;
	protected $table = 'information_categories';

	protected $fillable = [
		'alias',
		'title_ru',
		'title_kk'
	];

	public function information()
	{
		return $this->hasMany(Information::class, 'category_id');
	}
}
