<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ContentAppeal
 *
 * @property int $id
 * @property int $content_id
 * @property int $user_id
 * @property bool|null $status
 * @property string|null $description
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property SubStepContent $sub_step_content
 * @property User $user
 *
 * @package App\Models
 */
class ContentAppeal extends Model
{
	protected $table = 'content_appeals';

	protected $casts = [
		'content_id' => 'int',
		'user_id' => 'int',
		'status' => 'bool'
	];

	protected $fillable = [
		'content_id',
		'user_id',
		'status',
		'description'
	];

	public function user()
	{
		return $this->belongsTo(User::class, 'user_id');
	}
	public function sub_step_content()
	{
		return $this->belongsTo(SubStepContent::class, 'content_id');
	}
}
