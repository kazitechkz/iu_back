<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use App\Traits\CRUD;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TechSupportFile
 *
 * @property int $id
 * @property int $message_id
 * @property int $file_url
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property File $file
 * @property TechSupportMessage $tech_support_message
 *
 * @package App\Models
 */
class TechSupportFile extends Model
{
    use CRUD;
	protected $table = 'tech_support_files';

	protected $casts = [
		'message_id' => 'int',
		'file_url' => 'int'
	];

	protected $fillable = [
		'message_id',
		'file_url'
	];

	public function file()
	{
		return $this->belongsTo(File::class, 'file_url');
	}

	public function tech_support_message()
	{
		return $this->belongsTo(TechSupportMessage::class, 'message_id');
	}
}
