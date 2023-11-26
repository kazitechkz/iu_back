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
 * Class TechSupportMessage
 *
 * @property int $id
 * @property int $ticket_id
 * @property int $user_id
 * @property string $message
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property TechSupportTicket $tech_support_ticket
 * @property User $user
 * @property Collection|TechSupportFile[] $tech_support_files
 *
 * @package App\Models
 */
class TechSupportMessage extends Model
{
    use CRUD;
	protected $table = 'tech_support_messages';

	protected $casts = [
		'ticket_id' => 'int',
		'user_id' => 'int'
	];

	protected $fillable = [
		'ticket_id',
		'user_id',
		'message'
	];

	public function tech_support_ticket()
	{
		return $this->belongsTo(TechSupportTicket::class, 'ticket_id');
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

	public function tech_support_files()
	{
		return $this->hasMany(TechSupportFile::class, 'message_id');
	}
}
