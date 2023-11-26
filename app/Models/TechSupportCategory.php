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
 * Class TechSupportCategory
 *
 * @property int $id
 * @property string $title_ru
 * @property string $title_kk
 * @property string|null $title_en
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Collection|TechSupportTicket[] $tech_support_tickets
 *
 * @package App\Models
 */
class TechSupportCategory extends Model
{
    use CRUD;
	protected $table = 'tech_support_categories';

	protected $fillable = [
		'title_ru',
		'title_kk',
		'title_en'
	];

	public function tech_support_tickets()
	{
		return $this->hasMany(TechSupportTicket::class, 'category_id');
	}
}
