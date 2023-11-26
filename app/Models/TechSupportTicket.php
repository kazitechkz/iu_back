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
 * Class TechSupportTicket
 *
 * @property int $id
 * @property int $type_id
 * @property int $category_id
 * @property int $user_id
 * @property string $title
 * @property bool $is_closed
 * @property bool $is_resolved
 * @property bool $is_answered
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property TechSupportCategory $tech_support_category
 * @property TechSupportType $tech_support_type
 * @property User $user
 * @property Collection|TechSupportMessage[] $tech_support_messages
 *
 * @package App\Models
 */
class TechSupportTicket extends Model
{
    use CRUD;
	protected $table = 'tech_support_tickets';

	protected $casts = [
		'type_id' => 'int',
		'category_id' => 'int',
		'user_id' => 'int',
		'is_closed' => 'bool',
		'is_resolved' => 'bool',
		'is_answered' => 'bool'
	];

	protected $fillable = [
		'type_id',
		'category_id',
		'user_id',
		'title',
		'is_closed',
		'is_resolved',
		'is_answered'
	];

	public function tech_support_category()
	{
		return $this->belongsTo(TechSupportCategory::class, 'category_id');
	}

	public function tech_support_type()
	{
		return $this->belongsTo(TechSupportType::class, 'type_id');
	}

	public function user()
	{
		return $this->belongsTo(User::class)->select([
            'id',
            "username",
            'name',
            'phone',
            'email',
            'image_url'
        ])->with("file");
	}

	public function tech_support_messages()
	{
		return $this->hasMany(TechSupportMessage::class, 'ticket_id');
	}
}
