<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class SubStepContentTest
 *
 * @property int $id
 * @property int $test_id
 * @property int $user_id
 * @property bool $is_right
 * @property string $user_answer
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property SubStepTest $sub_step_test
 * @property User $user
 *
 * @package App\Models
 */
class SubStepContentTest extends Model
{
	protected $table = 'sub_step_content_test';

	protected $casts = [
		'test_id' => 'int',
		'user_id' => 'int',
		'is_right' => 'bool'
	];

	protected $fillable = [
		'test_id',
		'user_id',
		'is_right',
		'user_answer'
	];

	public function sub_step_test(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
		return $this->belongsTo(SubStepTest::class, 'test_id', 'id');
	}

	public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
		return $this->belongsTo(User::class);
	}
}
